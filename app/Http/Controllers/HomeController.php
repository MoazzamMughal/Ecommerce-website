<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Stripe;
use Session;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Catagory;




class HomeController extends Controller
{

    public function index()
    {


        $product = Product::paginate(10);
        //dd($product);
        $comment = comment::orderby('id', 'desc')->get();
        $reply = reply::all();
        $catagories = Catagory::all();


        return view('home.userpage', compact('product', 'comment', 'reply', 'catagories'));
    }


    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $total_product = product::all()->count();
            $total_order = order::all()->count();
            $total_user = user::all()->count();
            $order = order::all();
            $total_revenue = 0;
            foreach ($order as $order) {
                $total_revenue = $total_revenue + $order->price;
            }
            $total_delivered = order::where('Delivery_status', '=', 'delivered ')->get()->count();

            $total_processing = order::where('Delivery_status', '=', 'processing ')->get()->count();

            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        } else {

            $product = Product::paginate(10);

            $reply = reply::all();

            $comment = comment::orderby('id', 'desc')->get();

            $catagories = Catagory::all();


            return view('home.userpage', compact('product', 'comment', 'reply', 'catagories'));
        }
    }

    public function product_details($id)
    {

        $product = product::find($id);
        $catagories = Catagory::all();

        return view('home.product_details', compact('product', 'catagories'));
    }
    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $product = product::find($id);

            $userid = $user->id;
            $product_exist_id = cart::where('Product_id', '=', $id)->where('user_id', '=', $userid)->get('id')->first();

            if ($product_exist_id) {
                $cart = cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $cart->quantity;
                } else {
                    $cart->price = $product->price * $cart->quantity;
                }

                $cart->save();
                return redirect()->back()->with('massage', 'Product Added Successfully');
            } else {

                $cart = new cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;

                if ($product->discount_price != null) {
                    $cart->price = $product->discount_price * $request->quantity;
                } else {
                    $cart->price = $product->price * $request->quantity;
                }

                $cart->image = $product->image;
                $cart->Product_id = $product->id;
                $cart->quantity = $request->quantity;

                $cart->save();
                return redirect()->back()->with('massage', 'Product Added Successfully');
            }
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = cart::where('user_id', '=', $id)->get();
            $catagories = Catagory::all();
            return view('home.showcart', compact('cart', 'catagories'));
        } else {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();
        foreach ($data as  $data) {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;

            $order->payment_status = 'cash on deliver';
            $order->Delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('massage', 'We have Recevied your Order . We will Contect you soon...');
    }

    public function stripe($totalprice)
    {


        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request, $totalprice)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks For Payment."


        ]);


        $user = Auth::user();
        $userid = $user->id;


        $data = cart::where('user_id', '=', $userid)->get();
        foreach ($data as  $data) {
            $order = new order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;

            $order->payment_status = 'Paid';
            $order->Delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }


        session()->flash('success', 'Payment successful!');

        return back();
    }


    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userid = $user->id;


            $order = order::where('user_id', '=', $userid)->get();
            $catagories = Catagory::all();

            return view('home.order', compact('order', 'catagories'));
        } else {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->Delivery_status = 'Order is Canceled ';
        $order->save();
        return redirect()->back()->with('massage', 'Your Order Has Canceled');
    }


    public function add_comment(Request $request)

    {
        if (Auth::id()) {
            $comment = new comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function add_reply(Request $request)
    {
        if (Auth::id()) {
            $reply = new reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }

    public function product_search(Request $request)
    {

        $comment = comment::orderby('id', 'desc')->get();
        $reply = reply::all();
        $catagories = Catagory::all();


        $search_text = $request->search;
        $product = product::where('title', 'LIKE', "%$search_text%")->orWhere('catagory', 'LIKE', "$search_text")->paginate(10);

        return view('home.userpage', compact('product', 'comment', 'reply', 'catagories'));
    }




    public function product()
    {
        $product = Product::paginate(10);
        //dd($product);
        $comment = comment::orderby('id', 'desc')->get();
        $reply = reply::all();
        $catagories = Catagory::all();
        return view('home.all_product', compact('product', 'comment', 'reply', 'catagories'));
    }


    public function search_product(Request $request)
    {

        $comment = comment::orderby('id', 'desc')->get();
        $reply = reply::all();
        $catagories = Catagory::all();


        $search_text = $request->search;
        $product = product::where('title', 'LIKE', "%$search_text%")->orWhere('catagory', 'LIKE', "$search_text")->paginate(10);

        return view('home.all_product', compact('product', 'comment', 'reply', 'catagories'));
    }

    public function catagory_show($id)
    {

        $comment = comment::orderby('id', 'desc')->get();
        $reply = reply::all();
        $catagories = Catagory::all();
        $product = product::find($id);


        return view('home.catagory', compact('product', 'comment', 'reply', 'catagories'));
    }
}
