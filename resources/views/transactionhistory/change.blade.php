@extends('layouts.main')

@section('title', 'SPOS - Transkasi #' . $transaction->kode_transaksi)

@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
        <h3>Data Transaksi</h3>
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
            <h2>Transaksi #{{$transaction->kode_transaksi}}</h2>
            <div class="clearfix"></div>

            <div class="x_content">
                <div class="col-md-4 col-sm-4 col-xs-12" style="margin: 20px 0;">
                    <div style="font-size: 12pt;">
                        Pembeli: {{$transaction->nama_pembeli}} <small>({{$transaction->nomor_telepon}})</small>
                        <br />
                        Waktu Transaksi: {{$transaction->tanggal_transaksi}}
                        <br />
                        Total Transaksi: {{$me->rp($transaction->total_biaya_transaksi)}}
                    </div>
                </div>

                <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                    @if (count($errors) > 0)
                      <div class="alert alert-danger" style="margin: 10px 0;">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <div id="view-description">
                        <h3 class="prod_title">Transaksi #{{$transaction->kode_transaksi}}</h3>
                        <div>
                            @foreach ($details as $key => $value)
                                {{$value->nama_barang}} ({{$value->jumlah_transaksi_detil}})
                                <br />
                                {{$me->rp($value->harga_barang * $value->jumlah_transaksi_detil)}}
                                <br />
                                <hr />
                            @endforeach
                        </div>
                        <br />
                        <div>
                            <input type="button" class="btn btn-default btn-primary btn-lg change" onclick="$('#view-description').toggle();$('#change-description').toggle(); $('#view-thumbnail').toggle();$('#change-thumbnail').toggle();" value="Ubah" >
                            <a href="{{url('transaction/history/delete/'. $transaction->kode_transaksi)}}" class="btn btn-default btn-danger btn-lg">Hapus</a>
                        </div>
                    </div>
                    <br />
                    <div id="change-description">
                        <form method="post" name="" action="{{url('transaction/history/change/'. $transaction->kode_transaksi)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div style="margin: 10px 0;">
                                <div class="col-md-6 col-sm-6 col-xs-8" style="padding:0; margin: 10px 0;">
                                    <input name="buyer" class="form-control" type="text" placeholder="Pembeli" value="{{$transaction->nama_pembeli}}" />
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-4" style="padding:0; margin: 10px 0;">
                                    <input name="phone" class="form-control" type="text" placeholder="Nomor telepon" value="{{$transaction->nomor_telepon}}" />
                                </div>
                                <br />
                            </div>
                            @foreach ($details as $key => $value)
                            <div style="margin: 5px 0;">
                                <select name="items[]" class="form-control select2" style="width:100%;">
                                    @foreach ($items as $key2 => $value2)
                                        <option value="{{$value2->kode_barang}}" @if ($value->kode_barang == $value2->kode_barang) {{'selected="selected"'}} @endif>{{$value2->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin: 5px 0;">
                                <div class="col-md-6 col-sm-6 col-xs-8" style="padding:0; margin: 0;">
                                    <input id="quantity-{{$key}}" name="quantity[]" min="0" step="1" class="form-control" type="number" placeholder="Jumlah barang" value="{{$value->jumlah_transaksi_detil}}" onchange="$('#prices-{{$key}}').val($('#quantity-{{$key}}').val() * {{$value->harga_barang}});" />
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-4" style="padding:0; margin: 0;">
                                    <input id="prices-{{$key}}" name="prices[]" class="form-control" type="text" placeholder="Total Harga barang" value="{{$me->rp($value->harga_barang * $value->jumlah_transaksi_detil)}}" readonly />
                                </div>
                                <br />
                            </div>
                            <br />
                            @endforeach
                            <div>
                                <input type="submit" class="btn btn-default btn-primary btn-lg save" value="Simpan" >
                                <input type="button" class="btn btn-default btn-default btn-lg" onclick="$('#view-description').toggle();$('#change-description').toggle(); $('#view-thumbnail').toggle();$('#change-thumbnail').toggle();" value="Batalkan" >
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
