@section('header')

   <div class="col-md-3 left_col">
     <div class="left_col scroll-view">
       <div class="navbar nav_title" style="border: 0;">
         <a href="{{url('')}}" class="site_title"><i class="fa fa-star-o"></i> <span>SPOS</span></a>
       </div>

       <div class="clearfix"></div>

       <!-- menu profile quick info -->
       <div class="profile clearfix">
         <div class="profile_pic">
           <img src="{{url('images/profiles/default.png')}}" alt="User profile" class="img-circle profile_img">
         </div>
         <div class="profile_info">
           <h2>John Doe</h2>
         </div>
       </div>
       <!-- /menu profile quick info -->

       <br />

       <!-- sidebar menu -->
       <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
         <div class="menu_section">
           <h3>Menu Utama</h3>
           <ul class="nav side-menu">
             <li><a href="{{url('')}}"><i class="fa fa-home"></i> Beranda</a></li>
             <li><a href="{{url('items')}}"><i class="fa fa-edit"></i> Barang</a></li>
             <li><a href="{{url('employees')}}"><i class="fa fa-desktop"></i> Pegawai</a></li>
             <li><a><i class="fa fa-table"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
               <ul class="nav child_menu">
                 <li><a href="{{url('transaction')}}">Penjualan Barang</a></li>
                 <li><a href="{{url('transaction/history')}}">Catatan Transaksi</a></li>
               </ul>
             </li>
             <li><a><i class="fa fa-bar-chart-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
               <ul class="nav child_menu">
                 <li><a href="{{url('report/items')}}">Laporan Barang</a></li>
                 <li><a href="{{url('report/incomes')}}">Laporan Pendapatan</a></li>
               </ul>
             </li>
           </ul>
         </div>
       </div>
       <!-- /sidebar menu -->

       <!-- /menu footer buttons -->
       <div class="sidebar-footer hidden-small">
         <a data-toggle="tooltip" data-placement="top" title="Settings">
           <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
         </a>
         <a data-toggle="tooltip" data-placement="top" title="FullScreen">
           <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
         </a>
         <a data-toggle="tooltip" data-placement="top" title="Lock">
           <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
         </a>
         <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('logout')}}">
           <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
         </a>
       </div>
       <!-- /menu footer buttons -->
     </div>
   </div>

   <!-- top navigation -->
   <div class="top_nav">
     <div class="nav_menu">
       <nav>
         <div class="nav toggle">
           <a id="menu_toggle"><i class="fa fa-bars"></i></a>
         </div>

         <ul class="nav navbar-nav navbar-right">
           <li class="">
             <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
               <img src="{{url('images/profiles/default.png')}}" alt="">John Doe
               <span class=" fa fa-angle-down"></span>
             </a>
             <ul class="dropdown-menu dropdown-usermenu pull-right">
               <li><a href="{{url('profile')}}"> Profil</a></li>
               <li><a href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
             </ul>
           </li>
         </ul>
       </nav>
     </div>
   </div>
   <!-- /top navigation -->

@endsection

@section('footer')
   <!-- footer content -->
   <footer>
      <div class="pull-right">
        Thank you so much Gentelella, <a href="https://colorlib.com">Colorlib</a>
      </div>
      <div class="clearfix"></div>
   </footer>
   <!-- /footer content -->
@endsection
