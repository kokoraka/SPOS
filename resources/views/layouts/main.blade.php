<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_home_" content="{{url('/')}}" />
    <title>@yield('title')</title>

    <link rel="icon" href="images/favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons|Roboto|Roboto Mono">

    <link href="{{url('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <link href="{{url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <link href="{{url('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{url('assets/select2/css/select2.css')}}" rel="stylesheet">
    <link href="{{url('assets/build/css/custom.css')}}" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layouts.addition')
        @yield('header')
        @yield('content')
        @yield('footer')
      </div>
    </div>

    <script src="{{url('assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/vendors/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{url('assets/vendors/nprogress/nprogress.js')}}"></script>
    <script src="{{url('assets/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{url('assets/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <script src="{{url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <script src="{{url('assets/vendors/iCheck/icheck.min.js')}}"></script>

    <script src="{{url('assets/vendors/skycons/skycons.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{url('assets/vendors/Flot/jquery.flot.resize.js')}}"></script>

    <script src="{{url('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{url('assets/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{url('assets/vendors/flot.curvedlines/curvedLines.js')}}"></script>

    <script src="{{url('assets/vendors/DateJS/build/date.js')}}"></script>

    <script src="{{url('assets/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{url('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{url('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>

    <script src="{{url('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>


    <script src="{{url('assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{url('assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{url('assets/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{url('assets/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('assets/vendors/pdfmake/build/vfs_fonts.js')}}"></script>

    <script src="{{url('assets/select2/js/select2.js')}}"></script>
    <script src="{{url('assets/build/js/custom.js')}}"></script>
    <script src="{{url('assets/spos/js/spos.js')}}"></script>

  </body>
</html>
