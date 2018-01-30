@extends('layouts.main')

@section('title', 'SPOS - Nota Transaksi #' . $transaction->kode_transaksi)

@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
        <h3>Nota Transaksi #{{$transaction->kode_transaksi}}</h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-7">
        <div class="x_panel">

          <div class="x_title">
            <div class="clearfix"></div>

            <!-- print area -->
            <div id="receipt-transaction" class="row" style="background-color: white;">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>SPOS</h1>
                            <p>Simple Point of Sales</p>
                            <hr style="border: 1px dashed gray; margin: 10px 0;" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h2>Transaksi #{{$transaction->kode_transaksi}}</h2>
                        </div>
                        <div class="col-md-6 text-right">
                            {{$transaction->tanggal_transaksi}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            @if ($transaction->nama_pembeli || $transaction->nomor_telepon)
                                Pembeli: {{$transaction->nama_pembeli}} <small>({{$transaction->nomor_telepon}})</small>
                                <br />
                            @endif
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                          <hr style="border: 1px dashed gray; margin: 10px 0;" />
                      </div>
                    </div>
                    <div class="row text-center" style="font-size: 12pt; font-weight: bold; text-transform: uppercase;">
                        <div class="col-md-1">No.</div>
                        <div class="col-md-7">Barang</div>
                        <div class="col-md-4">Harga</div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                          <hr style="border: 1px dashed gray; margin: 10px 0;" />
                      </div>
                    </div>
                    @foreach ($details as $key => $value)
                    <div class="row text-center">
                        <div class="col-md-1">{{$key+1}}</div>
                        <div class="col-md-7">{{$value->nama_barang}} ({{$value->jumlah_transaksi_detil}})</div>
                        <div class="col-md-4">{{$me->rp($value->harga_barang * $value->jumlah_transaksi_detil)}}</div>
                    </div>
                    @endforeach
                    <div class="row">
                      <div class="col-md-12">
                          <hr style="border: 1px dashed gray; margin: 10px 0;" />
                      </div>
                    </div>
                    <div class="row text-right" style="font-size: 12pt; font-weight: bold;">
                        <div class="col-md-12">
                            <b style="text-transform: uppercase;">Total:</b>
                            {{$me->rp($transaction->total_biaya_transaksi)}}
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                          <hr style="border: 1px dashed gray; margin: 10px 0;" />
                      </div>
                    </div>
                </div>
            </div>
            <!-- print area -->
            <div class="row">
                <div class="col-md-6">
                    <a href="{{url('transaction/history/')}}" class="btn btn-default btn-lg btn-block">Kembali</a>
                </div>
                <div class="col-md-6">
                    <input id="receipt-print" type="button" class="btn btn-default btn-warning btn-lg btn-block" value="Cetak" >
                </div>
            </div>

          </div>

        </div> <!-- end xpanel -->
      </div> <!-- end col -->
    </div> <!--  end row -->

</div>
<!-- /page content -->

@endsection


@section('script', '
  <script src="' . url('assets/jspdf/jspdf.js') . '"></script>
  <script src="' . url('assets/jspdf/plugins/autoprint.js') . '"></script>
  <script src="' . url('assets/jspdf/plugins/html2canvas.js') . '"></script>
  <script src="' . url('assets/jspdf/plugins/html2pdf.js') . '"></script>
  <script src="' . url('assets/spos/js/report.js') . '"></script>
')
