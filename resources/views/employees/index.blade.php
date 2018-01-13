@extends('layouts.main')

@section('title', 'SPOS - Pegawai')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">

    <div class="title_left">
      <h3>Manajemen Pegawai</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="x_title">
          <h2>Tambah pegawai</h2>
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
            <form class="form-horizontal form-label-left" method="post" action="{{url('employees/add')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group col-md-3 col-sm-4 col-xs-12">
                <label class="control-label">Foto Pegawai</label>
                <div class="">
                  <img id="preview-thumbnail" class="img-circle" src="{{url('images/profiles/default.png')}}" alt="" width="140px" height="140px" style="margin: 10px 0;" />
                  <input name="thumbnail" type="file" title="Ubah gambar" onchange="reload_image(this, '#preview-thumbnail', '');" />
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Kode Pegawai</label>
                <div class="">
                  <input name="username" type="text" class="form-control" placeholder="Kode Pegawai" value="{{old('username')}}">
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Nama Pegawai</label>
                <div class="">
                  <input name="name" type="text" class="form-control" placeholder="Nama Pegawai" value="{{old('name')}}">
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Kata Sandi Pegawai</label>
                <div class="">
                  <input name="password" type="password" class="form-control" placeholder="Kata Sandi Pegawai" value="{{old('password')}}">
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Otoritas Pegawai</label>
                <div class="">
                  <select name="authority" class="form-control">
                    @foreach ($authority as $key => $value)
                      <option value="{{$value->kode_otoritas}}" @if (old('authority') == $value->kode_otoritas) {{'selected="selected"'}}@endif>{{$value->nama_otoritas}}</option>
                    @endforeach
                  </select>
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
          <h2>Data pegawai</h2>
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
                  <th>Nama</th>
                  <th>Otoritas</th>
                  <th>Operasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employees as $key => $value)
                <tr>
                  <td>{{$value->kode_pegawai}}</td>
                  <td>{{$value->nama_pegawai}}</td>
                  <td>
                    @foreach ($authority as $key2 => $value2)
                      @if ($value->kode_otoritas == $value2->kode_otoritas)
                        {{$value2->nama_otoritas}}
                      @endif
                    @endforeach
                  </td>
                  <td>
                    <a href="{{url('employees/view/' . $value->kode_pegawai)}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Lihat </a>
                    <a href="{{url('employees/delete/' . $value->kode_pegawai)}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus </a>
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
