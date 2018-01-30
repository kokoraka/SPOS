@extends('layouts.report')

@section('title', 'SPOS - Laporan Barang')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h1>SPOS - Simple Point of Sales</h1>
        <p style="font-size: 14pt;">Laporan Data Barang</p>
      </div>
    </div>

    <div class="row" style="margin-top: 10px;">
      <div class="col-md-12">
        <div>
          <table border="1" style="width: 100%; font-size: 10pt;" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
              </tr>
            </thead>
            <tbody>
              @php ($totals = 0)
              @foreach ($items as $key => $value)
              <tr>
                <td>{{$value->kode_barang}}</td>
                <td>{{$value->nama_barang}}</td>
                <td>{{$me->rp($value->harga_barang)}}</td>
                <td>{{$value->stok_barang}}</td>
              </tr>
              @php ($totals += $value->stok_barang)
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row" style="margin-top: 10px;">
      <div class="col-md-12">
        <p class="text-left" style="font-size: 14pt; font-weight: bold;">
          Total Stok: {{$totals}} Barang
        </p>
      </div>
    </div>

    <div class="row" style="margin-top: 10px;">
      <div class="col-md-12">
        <p class="text-right" style="font-size: 10pt;">
          {{date('D, d M Y - H:m:s')}}
        </p>
      </div>
    </div>

  </div>

@endsection
