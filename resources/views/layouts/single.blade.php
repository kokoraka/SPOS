<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons|Roboto|Roboto Mono">
    <link href="{{url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/build/css/custom.css')}}" rel="stylesheet">
    <link href="{{url('images/favicon.png')}}" rel="icon" type="image/x-icon">
  </head>
  <body class="login">

    @yield('header')
    @yield('content')
    @yield('footer')

    <script src="{{url('assets/jquery/jquery.js')}}"></script>
  </body>
</html>
