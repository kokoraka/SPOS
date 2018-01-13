@extends('layouts.main')

@section('title', 'SPOS - Hapus ' . $employee->nama_pegawai)

@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
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
            <h2>Hapus Data {{$employee->nama_pegawai}}?</h2>
            <div class="clearfix"></div>

            <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="product-image" style="padding: 15px;">
                        @php ($thumb = $employee->gambar_pegawai)
                        @if (!$thumb) @php ($thumb = 'default.png') @endif
                        <img src="{{url('images/profiles/'. $thumb)}}" alt="{{$employee->nama_pegawai}}" style="width:200px; height:200px;" />
                    </div>
                    <div class="product_gallery">

                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12" style="border:0px solid #e5e5e5;">
                    <div id="view-description">
                      <form method="post" name="" action="{{url('employees/delete/'. $employee->kode_pegawai)}}">
                         {{ csrf_field() }}
                        <br />
                        <div>
                            <h1>{{$employee->nama_pegawai}}</h1>
                            <p>
                                @foreach ($authority as $key => $value)
                                    @if ($value->kode_otoritas == $employee->kode_otoritas)
                                        {{$value->nama_otoritas}}
                                    @endif
                                @endforeach
                            </p>
                        </div>
                        <br />
                        <br />
                        <div>
                            <a href="{{url('employees/')}}" class="btn btn-default btn-default btn-lg">Kembali</a>
                            <input type="submit" class="btn btn-default btn-danger btn-lg" value="Hapus" >
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
