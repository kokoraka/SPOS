@extends('layouts.main')

@section('title', 'SPOS - Laporan Pendapatan')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">

    <div class="title_left">
      <h3>Laporan Pendapatan</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="x_title">
          <h2>Data Penjualan Barang</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>

          <hr />
          <div class="row">
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-12">
                <a href="{{url('/report/incomes/view')}}" type="button" class="btn btn-default btn-md btn-block" target="_blank"><i class="fa fa-search"></i> Lihat </a>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <button id="report-incomes-download" type="button" class="btn btn-default btn-md btn-block"><i class="fa fa-download"></i> Download </button>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <button id="report-incomes-print" type="button" class="btn btn-default btn-md btn-block"><i class="fa fa-print"></i> Cetak </button>
              </div>
            </div>
          </div>

          <div class="x_content">
            <p class="text-muted font-13 m-b-30"></p>
            <div>
              <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Waktu</th>
                    <th>Total Biaya</th>
                    <th>Pembeli</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($incomes as $key => $value)
                  <tr>
                    <td>{{$value->kode_transaksi}}</td>
                    <td>{{$value->tanggal_transaksi}}</td>
                    <td>{{$me->rp($value->total_biaya_transaksi)}}</td>
                    <td>{{$value->nama_pembeli}} ({{$value->nomor_telepon}})</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- end xpanel -->

    </div>
    <!-- end col -->
  </div>
  <!--  end row -->

  <div class="row">
    <div class="col-md-12" style="display: none;">
      <iframe id="incomes-report" src="{{url('report/incomes/view')}}" width="100%"></iframe>
    </div>
  </div>
</div>
<!-- /page content -->

@endsection

@section('script', '
  <script src="' . url('assets/jspdf/jspdf.js') . '"></script>
  <script src="' . url('assets/jspdf/plugins/autoprint.js') . '"></script>
  <script src="' . url('assets/jspdf/plugins/html2canvas.js') . '"></script>
  <script src="' . url('assets/spos/js/report.js') . '"></script>
')
