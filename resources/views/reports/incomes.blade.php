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
            <div class="form-group col-md-3">
                <div class="input-group date">
                    <input id="datepicker-start" type="text" class="form-control" placeholder="Tanggal Awal" />
                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group col-md-3">
                <div class="input-group date">
                    <input id="datepicker-end" type="text" class="form-control" placeholder="Tanggal Akhir" />
                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
            <div class="form-group col-md-6 col-sm-12 col-xs-12">
              <div class="btn-group" style="width:100%;">
                <button data-toggle="dropdown" class="btn btn-default btn-block dropdown-toggle" type="button" style="width:100%;" aria-expanded="false">Pilih Aksi <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu" style="width:100%;">
                  <li style="width:100%;">
                    <button id="report-incomes-view" type="button" class="btn btn-default btn-md btn-block"><i class="fa fa-search"></i> Lihat </button>
                  </li>
                  <li style="width:100%;">
                    <button id="report-incomes-download" type="button" class="btn btn-default btn-md btn-block"><i class="fa fa-download"></i> Download </button>
                  </li>
                  <li style="width:100%;">
                    <button id="report-incomes-print" type="button" class="btn btn-default btn-md btn-block"><i class="fa fa-print"></i> Cetak </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="x_content">
            <p class="text-muted font-13 m-b-30"></p>
            <div>
              <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Tanggal Transaksi</th>
                    <th>Total Pendapatan</th>
                    <th>Jumlah Barang Terjual</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($incomes as $key => $value)
                  <tr>
                    <td>{{$value->tanggal_transaksi}}</td>
                    <td>{{$me->rp($value->total_biaya_transaksi)}}</td>
                    <td>{{$value->jumlah_barang_transaksi}}</td>
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
