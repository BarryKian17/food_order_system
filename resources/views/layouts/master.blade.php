<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Font-awesone-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin/css/theme.css')}}" rel="stylesheet" media="all">
    <style>
        html {
          height: 100%;
        }
        body {
          margin:0;
          padding:0;
          font-family: sans-serif;
          background-image: url('{{asset('img/bg.avif')}}');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;

        }


        .login-box h2 {
          margin: 0 0 30px;
          padding: 0;
          color: #fff;
          text-align: center;
        }

        .login-box .user-box {
          position: relative;
        }

        .login-box .user-box input {
          width: 100%;
          padding: 10px 0;
          font-size: 16px;
          color: #fff;
          margin-bottom: 30px;
          border: none;
          border-bottom: 1px solid #fff;
          outline: none;
          background: transparent;
        }
        .login-box .user-box label {
          position: absolute;
          top:0;
          left: 0;
          padding: 10px 0;
          font-size: 16px;
          color: #fff;
          pointer-events: none;
          transition: .5s;
        }

        .login-box .user-box input:focus ~ label,
        .login-box .user-box input:valid ~ label {
          top: -20px;
          left: 0;
          color: #ffffff;
          font-size: 12px;
        }

        .login-box form button {
          position: relative;
          display: inline-block;
          padding: 10px 20px;
          color: #fbff00;
          font-size: 16px;
          text-decoration: none;
          text-transform: uppercase;
          overflow: hidden;
          transition: .5s;
         width: 250px;
          letter-spacing: 4px
        }

        .login-box button:hover {
          background: #fbff00;
          color: #ff0000;
          border-radius: 5px;
          box-shadow: 0 0 5px #ff0000,
                      0 0 25px #ff0000,
                      0 0 50px #ffffff,
                      0 0 100px #ffffff;
        }

        .login-box button span {
          position: absolute;
          display: block;
        }

        .login-box button span:nth-child(1) {
          top: 0;
          left: -100%;
          width: 100%;
          height: 5px;
          background: linear-gradient(90deg, transparent, #fbff00);
          animation: btn-anim1 1s linear infinite;
        }

        @keyframes btn-anim1 {
          0% {
            left: -100%;
          }
          50%,100% {
            left: 100%;
          }
        }

        .login-box button span:nth-child(2) {
          top: -100%;
          right: 0;
          width: 5px;
          height: 100%;
          background: linear-gradient(180deg, transparent, #fbff00);
          animation: btn-anim2 1s linear infinite;
          animation-delay: .25s
        }

        @keyframes btn-anim2 {
          0% {
            top: -100%;
          }
          50%,100% {
            top: 100%;
          }
        }

        .login-box button span:nth-child(3) {
          bottom: 0;
          right: -100%;
          width: 100%;
          height: 5px;
          background: linear-gradient(270deg, transparent, #fbff00);
          animation: btn-anim3 1s linear infinite;
          animation-delay: .5s
        }

        @keyframes btn-anim3 {
          0% {
            right: -100%;
          }
          50%,100% {
            right: 100%;
          }
        }

        .login-box button span:nth-child(4) {
          bottom: -100%;
          left: 0;
          width: 5px;
          height: 100%;
          background: linear-gradient(360deg, transparent, #fbff00);
          animation: btn-anim4 1s linear infinite;
          animation-delay: .75s
        }

        @keyframes btn-anim4 {
          0% {
            bottom: -100%;
          }
          50%,100% {
            bottom: 100%;
          }
        }
        .submit-box{

            text-align: center;
        }
        button{
            background: #ff0000;
        }

        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>

<body class="animsition">

    <section class="">

        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start">
          <div class="container">
            @yield('content')




        </div>
      </div>
      <!-- Jumbotron -->
    </section>
    <!-- Jquery JS-->
    <script src="{{asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('admin/js/main.js')}}"></script>
    <script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
       </script>
</body>

</html>
<!-- end document-->
