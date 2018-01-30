@extends('layouts.main')

@section('title', 'SPOS - Transaksi')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">

    <div class="title_left">
      <h3>Transaksi</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="x_title">
          <h2>Manajemen Transaksi</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
          <div class="clearfix"></div>

          <div class="x_content">
            <p class="text-muted font-13 m-b-30"></p>
            <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Waktu</th>
                  <th>Total Biaya</th>
                  <th>Pembeli</th>
                  <th>Operasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transactions as $key => $value)
                <tr>
                  <td>{{$value->kode_transaksi}}</td>
                  <td>{{$value->tanggal_transaksi}}</td>
                  <td>{{$me->rp($value->total_biaya_transaksi)}}</td>
                  <td>{{$value->nama_pembeli}} @if ($value->nomor_telepon) ({{$value->nomor_telepon}}) @endif</td>
                  <td>
                    <a href="{{url('transaction/history/receipt/' . $value->kode_transaksi)}}" class="btn btn-warning btn-xs"><i class="fa fa-print"></i> Cetak </a>
                    <a href="{{url('transaction/history/view/' . $value->kode_transaksi)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Lihat </a>
                    <a href="{{url('transaction/history/delete/' . $value->kode_transaksi)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- end xpanel -->

    </div>
    <!-- end col -->
  </div>
  <!--  end row -->

</div>
<!-- /page content -->

@endsection
