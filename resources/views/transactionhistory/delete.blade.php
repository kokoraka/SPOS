@extends('layouts.main')

@section('title', 'SPOS - Hapus Transaksi #' . $transaction->kode_transaksi)

@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

        </div>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

          <div class="x_title">
            <h2>Hapus Data Transaksi #{{$transaction->kode_transaksi}}?</h2>
            <div class="clearfix"></div>

            <div class="x_content">
                <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                    <div id="view-description">
                      <form method="post" name="" action="{{url('transaction/history/delete/'. $transaction->kode_transaksi)}}">
                         {{ csrf_field() }}
                        <br />
                        <div style="font-size: 12pt;">
                            Pembeli: {{$transaction->nama_pembeli}} <small>({{$transaction->nomor_telepon}})</small>
                            <br />
                            Waktu Transaksi: {{$transaction->tanggal_transaksi}}
                            <br />
                            Total Transaksi: {{$me->rp($transaction->total_biaya_transaksi)}}
                        </div>
                        <br />
                        <div>
                            <a href="{{url('transaction/history/')}}" class="btn btn-default btn-default btn-lg">Kembali</a>
                            <input type="submit" class="btn btn-default btn-danger btn-lg" value="Hapus" >
                        </div>
                      </form>
                    </div>
                </div>

            </div>
          </div>

        </div> <!-- end xpanel -->
      </div> <!-- end col -->
    </div> <!--  end row -->

</div>
<!-- /page content -->

@endsection
