@extends('layouts.main')

@section('title', 'SPOS - Profil')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="page-title">

    <div class="title_left">
      <h3>Profil</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="x_panel">
        <div class="x_title">

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
            <form class="form-horizontal form-label-left" method="post" action="{{url('profile/save')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group col-md-3 col-sm-4 col-xs-12">
                <label class="control-label">Foto Profil</label>
                <div class="">
                  @php ($path = 'default.png')
                  @if (Auth::guard('employee')->user()->gambar_pegawai)
                    @php ($path = Auth::guard('employee')->user()->gambar_pegawai)
                  @endif
                  <img id="preview-thumbnail" class="img-circle" src="{{url('images/profiles/' . $path)}}" alt="" width="140px" height="140px" style="margin: 10px 0;" />
                  <input name="thumbnail" type="file" title="Ubah gambar" onchange="reload_image(this, '#preview-thumbnail', '');" />
                </div>
              </div>
              <div class="form-group col-md-4 col-sm-4 col-xs-12">
                <label class="control-label">Nama Pegawai</label>
                <div class="">
                  <input name="name" type="text" class="form-control" placeholder="Nama Pegawai" value="{{Auth::guard('employee')->user()->nama_pegawai}}">
                </div>

                <label class="control-label">Kata Sandi Pegawai</label>
                <div class="">
                  <input name="password" type="password" class="form-control" placeholder="Kata Sandi Pegawai" value="{{old('password')}}">
                </div>
                <hr />
                <div>
                  <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                  <button type="reset" class="btn btn-danger pull-right">Batalkan</button>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div>
      <!-- end xpanel -->

    </div>
    <!-- end col -->
  </div>

</div>
<!-- /page content -->

@endsection
