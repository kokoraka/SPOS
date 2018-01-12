@extends('layouts.main')

@section('title', 'SPOS - Barang')

@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
        <h3>Manajemen Barang</h3>
      </div>
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
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
              <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>

            <div class="x_content">
              <p class="text-muted font-13 m-b-30"></p>
              <table id="datatable-fixed-header" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Operasi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($items as $key => $value)
                <tr>
                  <td>{{$value->nama_barang}}</td>
                  <td>{{$me->rp($value->harga_barang)}}</td>
                  <td>{{$value->stok_barang}}</td>
                  <td>
                    <a href="{{url('items/view/' . $value->kode_barang)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Ubah </a>
                    <a href="{{url('items/delete/' . $value->kode_barang)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>

        </div> <!-- end xpanel -->
      </div> <!-- end col -->
    </div> <!--  end row -->

</div>
<!-- /page content -->

@endsection
