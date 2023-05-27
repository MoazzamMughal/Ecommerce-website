<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
<style type="text/css">
  .div_center
  {
    text-align: center;
    padding: 40px;

  }
  .h2_font
  {
    font-size: 40px;
    padding-bottom: 40px;
    font-weight:   bold;
  }
  .input_color{
    color: black
  }
  .center
  {
    margin: auto;
    width: 50%;
    text-align: center;
    margin-top: 30px;
    border:3px solid white;


  }
  td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

.th_color
        {
            background-color: green;
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

                 <div class="div_center">
              <h1 class="h2_font">Add Catagory</h1>

              <form action="{{ url('/add_catagory') }}" method="post">
                @csrf
                <input class="input_color" type="text" name="catagory" placeholder="Write catagory name">
                <input type="submit" class="btn btn-primary" name="submit" value="Add Catagory">
              </form>

                 </div>

                 <table class="center">
                    <tr class="th_color">
                        <th>Catagory Name</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($data as $data )


                       <tr>
                           <td>{{ $data->catagory_name }}</td>
                             <td>
                              <a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="{{ url('delete_catagory',$data->id) }}">Delete</a>
                             </td>
                      </tr>
                    @endforeach
                 </table>

             </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
