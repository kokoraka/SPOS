@extends('layouts.main')

@section('title', 'SPOS - Barang')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">

    <div class="title_left">
      <h3>Manajemen Barang</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="x_title">
          <h2>Tambah Barang</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
          </ul>
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
            <form class="form-horizontal form-label-left" method="post" action="{{url('items/add')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Nama Barang</label>
                <div class="">
                  <input name="name" type="text" class="form-control" placeholder="Nama Barang" value="{{old('name')}}">
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Harga Barang</label>
                <div class="">
                  <input name="price" type="number" class="form-control" placeholder="Harga Barang" value="{{old('price')}}">
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Stok Barang</label>
                <div class="">
                  <input name="stock" type="number" class="form-control" placeholder="Stok Barang" value="{{old('stock')}}">
                </div>
              </div>

              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label class="control-label">Deskripsi Barang</label>
                <div class="">
                  <textarea name="description" class="form-control" rows="5" placeholder="Deskripsi Barang">{{old('description')}}</textarea>
                </div>
              </div>

              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <label class="control-label">Gambar Barang</label>
                <div class="">
                  <img id="preview-thumbnail" class="img-thumbnail" src="{{url('images/thumbs/default.jpg')}}" alt="" width="140px" height="140px" />
                  <input name="thumbnail" type="file" title="Ubah gambar" onchange="reload_image(this, '#preview-thumbnail', '');" />
                </div>
              </div>
              <div class="ln_solid"></div>

              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary pull-right">Tambah</button>
                <button type="reset" class="btn btn-danger pull-right">Batalkan</button>
              </div>

            </form>

          </div>
        </div>
      </div>
      <!-- end xpanel -->

    </div>
    <!-- end col -->
  </div>
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
                    <a href="{{url('items/view/' . $value->kode_barang)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Lihat </a>
                    <a href="{{url('items/delete/' . $value->kode_barang)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
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
