<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .div_center
        {
            text-align: center;
            padding: 40px;
            border: 2px solid white;
            width: 70%;
            margin: auto;

        }
        .font_size
        {
            text-align: center;
            font-size: 40px;
            padding-top: 40px;
            padding-bottom:40px;
            font-weight:   bold;



        }
        .text_color
        {
            color: black;
            padding-bottom:20px;
        }
        label
        {
            display: inline-block;
            width:200px;
        }
        .div_design
        {
          padding-bottom: 15px;
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

                @if (session()->has('massage'))

                <div class="alert alert-success">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      {{session()->get('massage')  }}
                </div>
               @endif


               <h1 class="font_size" >Add Products</h1>




             <form action="{{ URL('/add_product') }}" method="POST" enctype="multipart/form-data">


               @csrf


                <div class="div_center">

                    <div class="div_design">
                    <label> Product Title :</label>
                    <input class="text_color" type="text" name="title" placeholder="write a title" required="">
                    </div>

                    <div class="div_design">
                    <label>Product Description :</label>
                    <input class="text_color" type="text" name="description" placeholder="write a description"required="">
                    </div>

                    <div class="div_design">
                    <label>Product Price :</label>
                    <input class="text_color" type="number" name="price" placeholder="write a Price"required="">
                    </div>


                    <div class="div_design">
                    <label>  Discount Price :</label>
                    <input class="text_color" type="number" name="dis_price" placeholder="write a Price">
                    </div>

                    <div class="div_design">
                    <label>Product Quantity :</label>
                    <input class="text_color" type="number" min="0" name="quantity" placeholder="write a Quantity"required="">
                    </div>


                    <div class="div_design">
                    <label> Product Catagory :</label>
                    <select class="text_color" name="catagory"required="">

                    <option value="" selected="">Add a Catagory here</option>

                    @foreach ($catagory as $catagory)

                    <option >{{$catagory->catagory_name}}</option>
                    {{-- value="$catagory->catagory_name" --}}
                    @endforeach
                    </select>
                    </div>


                    <div class="div_design">
                    <label>Product Image Here:</label>
                    <input type="file" name="image"required="">
                    </div>

                    <div class="div_design">

                        <input type="submit" value="Add Product" class="btn btn-primary" >
                    </div>

                </form>
                        </div>
                        </div>

                <!-- container-scroller -->
                <!-- plugins:js -->
                @include('admin.script')
                <!-- End custom js for this page -->
  </body>
</html>
