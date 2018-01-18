@extends('layouts.main')

@section('title', 'SPOS - Beranda')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-users"></i> Pegawai</span>
      <div class="count">{{$board['employees']}} <small>Pegawai</small></div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-book"></i> Stok Barang</span>
      <div class="count">{{$board['items']}} <small>Barang</small></div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-calculator"></i> Barang Terjual</span>
      <div class="count">{{$board['transactions']}} <small>Barang</small></div>
      <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> Seluruh waktu</span> -->
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-money"></i> Pendapatan</span>
      <div class="count">{{$me->rp($board['incomes'])}}</div>
      <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> Seluruh waktu</span> -->
    </div>
  </div>
  <!-- /top tiles -->

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="dashboard_graph">

        <div class="row x_title">
          <div class="col-md-6">
            <h3>Transaksi <small>Penjualan Barang</small></h3>
          </div>
          <div class="col-md-6"></div>
        </div>

        <div class="col-md-9 col-sm-9 col-xs-12">
          {{ csrf_field() }}
          <canvas id="transaction-chart" width="100%" height="40"></canvas>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
          <div class="x_title">
            <h2>Barang terlaris</h2>
            <div class="clearfix"></div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-6">
            @foreach ($popular as $key => $value)
            <div>
              <p>{{$value->nama_barang}}</p>
              <div class="">
                <div class="progress progress_sm" style="width: {{$value->persentasi_barang}}%;">
                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$value->persentasi_barang}}"></div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div class="clearfix"></div>
      </div>
    </div>

  </div>
  <br />

  <div class="row">

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Stok Barang</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          @if (count($stock) > 0)
            @foreach ($stock as $key => $value)
            <div class="widget_summary">
              <div class="w_left w_25">
                <span>{{substr($value->nama_barang, 0, 19) . '...'}}</span>
              </div>
              <div class="w_center w_55">
                <div class="progress">
                  <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{$value->persentasi_barang}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$value->persentasi_barang}}%;">
                    <span class="sr-only">{{$value->persentasi_barang}}% dari Total Barang</span>
                  </div>
                </div>
              </div>
              <div class="w_right w_20">
                <span>{{$value->stok_barang}} Barang</span>
              </div>
              <div class="clearfix"></div>
            </div>
            @endforeach
          @else
            Barang tidak tersedia.
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel tile fixed_height_320 overflow_hidden">
        <div class="x_title">
          <h2>Barang Terlaris</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="" style="width:100%">
            <tr>
              <th>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <p class="">Barang</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <p class="">Persentasi Penjualan</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                  <p class="">Total Terjual</p>
                </div>
              </th>
            </tr>
            <tr>
              <td>
                <table class="tile_info">
                  <?php
                    $colors = ['blue', 'green', 'purple', 'aero', 'red']
                  ?>
                  @foreach ($popular as $key => $value)
                    <tr>
                      <td>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                          <p><i class="fa fa-square {{$colors[$key]}}"></i>{{substr($value->nama_barang, 0, 19) . '...'}} </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                          <p>{{$value->persentasi_barang}}%</p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                          <p class="">{{$value->total_terjual}} Barang</p>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </table>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>

  </div> <!-- end row -->

</div>
<!-- /page content -->

@endsection
