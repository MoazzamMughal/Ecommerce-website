<!DOCTYPE html>
<html>
   <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>E-Commerce</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }} "rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />

      <style>
        .center
        {
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
        }

        table,th,td
        {
         border: 1px solid black;
        }
        .th_deg
        {
          padding: 10px;
          background-color: skyblue;
          font-size: 20px;
          font-weight: bold;
        }

.heading
        {
            font-size: 40px;
            text-align: center;

        }



      </style>
   </head>
   <body>



         <!-- header section strats -->
       @include('home.header')
         <!-- end header section -->
         @if (session()->has('massage'))

         <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
               {{session()->get('massage')  }}
         </div>
        @endif
         <div>

            <br>
            <h1 class="heading"><b> Your Orders</b></h1>
            <div class="center" >

                <table>
                    <tr>
                        <th class="th_deg">Product Title</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Payment Status</th>
                        <th class="th_deg">Deliver Status</th>
                        <th class="th_deg">Image</th>
                        <th class="th_deg">Cancel order</th>

                    </tr>
                    @foreach ($order as $order )

                    <tr>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->Delivery_status }}</td>
                        <td>
                            <img height="20px" width="120" src="product/{{ $order->image }}" >
                        </td>

                        <td>
                           @if ($order ->Delivery_status=='processing')



                            <a onclick="return confirm('Are You Sure To Cancel The Order')" class="btn btn-danger" href="{{ url('cancel_order',$order->id) }}">Cancel order</a>


                            @else

                                <b><p style="color: rgb(207, 54, 34)">Not Allowed</p></b>


                        @endif
                    </td>

                    </tr>

                    @endforeach

                </table>

            </div>
        </div>

<br><br>
      <div class="cpy_" style="color:aliceblue">


        &copy; E-Commerce | <span id="clock"></span>


      </div>





      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>



      <script>
        function updateTime() {
        const now = new Date();
        const clock = document.getElementById("clock");
        clock.innerText = now.toLocaleString();
        }

        setInterval(updateTime, 1000); // update every second
        </script>

   </body>
</html>
