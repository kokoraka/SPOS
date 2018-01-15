@extends('layouts.main')

@section('title', 'SPOS - Transaksi Penjualan Barang')

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
          <h2>Penjualan Barang</h2>
          <div class="clearfix"></div>

          <div class="x_content">
            <p class="text-muted font-13 m-b-30"></p>

            @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form class="form-horizontal form-label-left" method="post" action="{{url('transaction/add')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group col-md-8 col-sm-7 col-xs-12" style="font-size: 14pt; font-weight: bold; margin: 10px 0;">
                <div id="current-time"></div>
              </div>
              <div class="form-group col-md-4 col-sm-5 col-xs-12 text-right" style="font-size: 16pt; font-weight: bold; margin: 10px 0;">
                <div id="total-transaction" style="padding: 15px; border: 2px solid black; background-color: black; color: white;">
                  @php ($total = 0)
                  @if (count($orders) > 0)
                    @foreach ($orders as $key => $value)
                      @php ($total += $orders[$key]['harga_barang'] * $orders[$key]['jumlah_barang'])
                    @endforeach
                  @endif
                  {{$me->rp($total)}}
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <hr />
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="control-label"></label>
                <div>
                  <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Operasi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if (count($orders) > 0)
                      @foreach ($orders as $key => $value)
                        <tr>
                          <td>{{$orders[$key]['nama_barang']}}</td>
                          <td>{{$me->rp($orders[$key]['harga_barang'])}}</td>
                          <td>{{$orders[$key]['jumlah_barang']}}</td>
                          <td>{{$me->rp($orders[$key]['harga_barang'] * $orders[$key]['jumlah_barang'])}}</td>
                          <td>
                            <button type="button" class="btn btn-danger btn-xs" onclick="remove_item({{$orders[$key]['kode_barang']}});"><i class="fa fa-trash-o"></i> Hapus </button>
                          </td>
                        </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="form-group col-md-5 col-sm-4 col-xs-12">
                <label class="control-label">Barang</label>
                <div class="">
                  <select id="item-id" name="item" class="form-control select2" style="width: 100%;">
                    @foreach ($items as $key => $value)
                      <option value="{{$value->kode_barang}}">[{{$value->kode_barang}}] {{$value->nama_barang}} - {{$me->rp($value->harga_barang)}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group col-md-3 col-sm-4 col-xs-12">
                <label class="control-label">Jumlah Barang</label>
                <div class="">
                  <input id="item-quantity" name="quantity" type="number" min="1" class="form-control" placeholder="Jumlah Barang" style="height: 45px;">
                </div>
              </div>

              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">&nbsp;</label>
                <div class="">
                  <button id="add-item" type="button" class="btn btn-lg btn-default btn-block">
                    <i class="fa fa-cart-plus" aria-hidden="true"></i>
                    Tambah Barang
                  </button>
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-12" onclick="$('#identity').toggle();">
                <hr />
                <span class="text-left">Identitas Pembeli (optional) </span>
                <span class="text-right"><i class="fa fa-chevron-down"></i></span>
              </div>

              <div id="identity">
                <div class="form-group col-md-5 col-sm-5 col-xs-12">
                  <label class="control-label">Nama Pembeli</label>
                  <div class="">
                    <input name="name" type="text" class="form-control" placeholder="Nama Pembeli" value="{{old('name')}}">
                  </div>

                  <label class="control-label">Nomor Telepon</label>
                  <div class="">
                    <input name="phone" type="text" class="form-control" placeholder="Nomor Telepon" value="{{old('phone')}}">
                  </div>
                </div>
                <div class="form-group col-md-7 col-sm-7 col-xs-12">
                  <label class="control-label">Keterangan</label>
                  <div class="">
                    <textarea name="addition" class="form-control" rows="5" placeholder="Keterangan Transaksi">{{old('addition')}}</textarea>
                  </div>
                </div>
              </div>


              <div class="form-group col-md-4 col-sm-7 col-xs-12">
                <label class="control-label">Uang Tunai</label>
                <div class="">
                  <input id="item-cash" name="cash" type="number" min="{{$total}}" value="{{$total}}" class="form-control" placeholder="Uang Tunai" style="height: 45px;" >
                </div>
              </div>
              <div class="form-group col-md-4"></div>
              <div class="form-group col-md-4 col-sm-5 col-xs-12 text-right" style="font-size: 16pt; font-weight: bold; margin: 10px 0;">
                <div id="return-transaction" style="padding: 15px; border: 2px solid gray; background-color: gray; color: white;">
                  {{$me->rp(0)}}
                </div>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <hr />
              </div>

              <div class="ln_solid"></div>

              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <button id="reset-transaction" type="reset" class="btn btn-lg btn-danger btn-block">Batalkan Transaksi</button>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <button type="submit" class="btn btn-lg btn-success btn-block">Proses Transaksi</button>
              </div>
            </form>

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

@section('meta', '<meta name="_totals_" content="' . $total . '" />')
