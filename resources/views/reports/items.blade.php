@extends('layouts.main')

@section('title', 'SPOS - Laporan Barang')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">

    <div class="title_left">
      <h3>Laporan Barang</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="x_title">
          <h2>Data Barang</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>

          <hr />
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <button id="report-items-download" type="button" class="btn btn-default btn-md btn-block"><i class="fa fa-download"></i> Download </button>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <button id="report-items-print" type="button" class="btn btn-default btn-md btn-block"><i class="fa fa-print"></i> Cetak </button>
            </div>
          </div>

          <div class="x_content">
            <p class="text-muted font-13 m-b-30"></p>
            <div>
              <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $key => $value)
                  <tr>
                    <td>{{$value->kode_barang}}</td>
                    <td>{{$value->nama_barang}}</td>
                    <td>{{$me->rp($value->harga_barang)}}</td>
                    <td>{{$value->stok_barang}}</td>
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
      <iframe id="items-report" src="{{url('report/items/view')}}" width="100%"></iframe>
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
