@extends('layouts.main')

@section('title', 'SPOS - ' . $employee->nama_pegawai)

@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
        <h3>Data Pegawai</h3>
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
            <h2>{{$employee->nama_pegawai}}</h2>
            <div class="clearfix"></div>

            <div class="x_content">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div id="view-thumbnail" class="product-image" style="padding: 5px;">
                        @php ($thumb = $employee->gambar_pegawai)
                        @if (!$thumb) @php ($thumb = 'default.png') @endif
                        <img src="{{url('images/profiles/'. $thumb)}}" class="img-circle" alt="{{$employee->nama_pegawai}}" style="width: 250px; height: 250px;" />
                    </div>
                    <div id="change-thumbnail" style="display: none;">
                        <br />
                      <div class="">
                        <img id="preview-thumbnail" class="img-circle" src="{{url('images/profiles/'. $thumb)}}" alt="" style="width: 250px; height: 250px;" />
                      </div>
                    </div>
                </div>

                <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
                    <br />
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                    <div id="view-description">
                        <h3 class="prod_title">{{$employee->nama_pegawai}}</h3>
                        <div>
                            @foreach ($authority as $key => $value)
                                @if ($value->kode_otoritas == $employee->kode_otoritas)
                                    {{$value->nama_otoritas}}
                                @endif
                            @endforeach
                        </div>
                        <br />
                        <div>
                            <input type="button" class="btn btn-default btn-primary btn-lg change" onclick="$('#view-description').toggle();$('#change-description').toggle(); $('#view-thumbnail').toggle();$('#change-thumbnail').toggle();" value="Ubah" >
                            <a href="{{url('employees/delete/'. $employee->kode_pegawai)}}" class="btn btn-default btn-danger btn-lg">Hapus</a>
                        </div>
                    </div>
                    <br />
                    <div id="change-description">
                        <form method="post" name="" action="{{url('employees/change/'. $employee->kode_pegawai)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div>
                                <input name="name" class="form-control" type="text" placeholder="Nama pegawai" value="{{$employee->nama_pegawai}}" />
                            </div>
                            <br />
                            <div>
                                <input name="password" class="form-control" type="password" placeholder="Kata sandi pegawai" value="" />
                            </div>
                            <br />
                            <div>
                                <input name="password_confirmation" class="form-control" type="password" placeholder="Konfirmasi kata sandi pegawai" value="" />
                            </div>
                            <br />
                            <div>
                                <select name="authority" class="form-control">
                                  @foreach ($authority as $key => $value)
                                    <option value="{{$value->kode_otoritas}}" @if ($employee->kode_otoritas == $value->kode_otoritas) {{'selected="selected"'}}@endif>{{$value->nama_otoritas}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <br />
                            <div>
                                <input name="thumbnail" type="file" title="Ubah gambar" onchange="reload_image(this, '#preview-thumbnail', '');" />
                            </div>
                            <br />
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
