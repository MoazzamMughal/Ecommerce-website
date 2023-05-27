<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>

        .title_deg
        {

          text-align: center;
          font-size: 40px;
          font-weight:   bold;
          padding-bottom: 40px;
        }
        .table_deg
        {

            font-family: arial, sans-serif;
            border-collapse: collapse;
             width: 100%;
            text-align: center;
            background-color: #8b2424;

        }
        .th_deg
        {
            background: green;
        }

        .img_size
        {
          width: 200px;
          height: 100px;
        }

td, th {
  border: 2px solid #dddddd;
  text-align: center;
  padding: 10px;
}
.content-wrapper {
        overflow-y: scroll;

    }
    </style>
  </head>
  <body>
    <div class="container-scroller">



      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->


        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <h1 class="title_deg">All Orders</h1>

                <div style="text-align: center; padding-bottom:30px;">
                    <form action="{{ url('search') }}" method="get">
                        @csrf
                        <input style="color: black" type="text" name="search" placeholder="Search for Something">

                        <input type="submit" value="Search" class="btn btn-outline-primary">
                    </form>
                </div>

                <table class="table_deg">
                    <tr class="th_deg">
                        <th >Nmae</th>
                        <th >Email</th>
                        <th >Address</th>
                        <th >Phone</th>
                        <th >Product title</th>
                        <th >Quantity</th>
                        <th >Price</th>
                        <th >Payment Status</th>
                        <th >Delivery Status</th>
                        <th >Image</th>
                        <th >Delivered</th>
                        <th >Print PDF</th>
                        <th >Send Email</th>
                    </tr>
                    @forelse ($order as $order)


                    <tr >
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity}}</td>
                        <td>${{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->Delivery_status}}</td>
                        <td>
                            <img  class="img_size" src="/product/{{ $order->image }}" >
                        </td>
                        <td>
                            @if ($order->Delivery_status =='processing')


                             <a onclick="return confirm('Are You Sure This Product is Delivered ?')" class="btn btn-success" href="{{ url('delivered', $order->id) }}">Delivered</a>
                             @else
                             <p style="color:green;">Delivered</p>

                             @endif
                        </td>
                        <td>
                           <a class="btn btn-secondary" href="{{ url('print_pdf', $order->id) }}">Print PDF</a>
                        </td>
                        <td>
                            <a class="btn btn-outline-info" href="{{ url('send_email',$order->id) }}">Send Email</a>
                         </td>
                    </tr>

                    @empty

                    <tr>
                        <td> No Data Found... </td>
                    </tr>
                    @endforelse
                </table>

             </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->


  </body>
</html>
