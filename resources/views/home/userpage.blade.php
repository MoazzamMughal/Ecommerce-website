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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   <body>

      <div class="hero_area">

         <!-- header section strats -->
       @include('home.header')
         <!-- end header section -->

         <!-- slider section -->
         @include('home.slider')
         <!-- end slider section -->
      </div>

      <!-- why section -->
      @include('home.why')
      <!-- end why section -->

      <!-- arrival section -->
      @include('home.arrival')
      <!-- end arrival section -->

      <!-- product section -->
      @include('home.product')
      <!-- end product section -->



            <!-- Comment and reply-->


<div style="text-align: center; padding-bottom:30px; " >
    <h1 style="font-size:30px; text-align:center; padding-top:20px; padding-bottom:20px; ">Comments</h1>

    <form action="{{ URL('add_comment') }}" method="POST">
        @csrf
        <textarea style="height: 150px; width:600px; " placeholder="Comment something here" name="comment"></textarea>
        <br>
     <input class="btn btn-primary" type="submit" value="Comment">
    </form>
</div>

<div style="padding-left:20%; ">
    <h1 style="font-size:20px; padding-bottom:20px;">All Comments</h1>

 @foreach ($comment as $comment)



        <div>
            <b>{{ $comment->name }}</b>
            <p>{{ $comment->comment }}</p>

            <a style="color:blue"   href="javascript::void(0);" onclick="reply(this)"data-Commentid="{{ $comment->id }}">Reply</a>

            @foreach ($reply as $rep)


@if ($rep->comment_id==$comment->id)


            <div style="padding-left: 3%; padding-bottom:10px ">

                <b>{{ $rep->name }}</b>
                 <p>{{ $rep->reply }}</p>
                 <a style="color:blue"  href="javascript::void(0);" onclick="reply(this)"data-Commentid="{{ $comment->id }}">Reply</a>
            </div>
            @endif
            @endforeach


        </div>

@endforeach





<!---Reply textbox-->


<div style="display:none;" class="replyDiv">

    <form action="{{ url('add_reply') }}" method="POST">
        @csrf

    <input type="text" id="commentId" name="commentId" hidden>
    <textarea style="height:100px; width:500px;" name="reply" placeholder="Write something here"></textarea>
    <br>

    <button type="submit" class="btn btn-outline-success">Reply</button>
    <a onclick="reply_close(this)" class="btn btn-outline-danger" href="javascript::void(0);">Close</a>

</form>
</div>


</div>



           <!-- Comment and reply -->


      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->

      <!-- client section -->
      @include('home.client')
      <!-- end client section -->

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->

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
