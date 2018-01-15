@extends('layouts.report')

@section('title', 'SPOS - Laporan Pendapatan')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h1>SPOS - Simple Point of Sales</h1>
        <p style="font-size: 14pt;">Laporan Pendapatan</p>
      </div>
    </div>

    <div class="row" style="margin-top: 10px;">
      <div class="col-md-12">
        <div>
          <table border="1" style="width: 100%; font-size: 10pt;" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Waktu</th>
                <th>Total Biaya</th>
                <th>Pembeli</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($incomes['trx'] as $key => $value)
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

    <div class="row" style="margin-top: 10px;">
      <div class="col-md-12">
        <p class="text-right" style="font-size: 10pt;">
          {{date('D, d M Y - H:m:s')}}
        </p>
      </div>
    </div>

  </div>

@endsection
