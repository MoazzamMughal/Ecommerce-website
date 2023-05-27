<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Commerce</title>




</head>
<body>

</body>
</html>














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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
                background: skyblue;
              }

      </style>



    </head>

      <body>

      <div class="hero_area">

         <!-- header section strats -->
       @include('home.header')
         <!-- end header section -->






            <!-- Comment and reply-->


            <table class="center" >
                <tr class="th_color">
                    <th>Catagory Names</th>

                </tr>
                @foreach ($catagories as $catagory )


                   <tr>
                       <td><button class="btn btn-success"><a style="color:aliceblue" href="{{ url('products') }}">{{ $catagory->catagory_name }}</a></button></td>

                  </tr>
                @endforeach
             </table>


           </div>



           <!-- Comment and reply -->





      <div class="cpy_" style="color:aliceblue">
        &copy; E-Commerce | <span id="clock"></span>
      </div>

      <script>
        function reply(caller) {
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
          $('.replyDiv').insertAfter($(caller));
          $('.replyDiv').show();
        }
        function reply_close(caller) {

          $('.replyDiv').hide();
        }



      </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>


      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

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

