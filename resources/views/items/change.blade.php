@extends('layouts.main')

@section('title', 'SPOS - ' . $item->nama_barang)

@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="page-title">
      <div class="title_left">
        <h3>Data Barang</h3>
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
            <h2>{{$item->nama_barang}}</h2>
            <div class="clearfix"></div>

            <div class="x_content">
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div id="view-thumbnail" class="product-image" style="padding: 5px;">
                        @php ($thumb = $item->gambar_barang)
                        @if (!$thumb) @php ($thumb = 'default.jpg') @endif
                        <img src="{{url('images/thumbs/'. $thumb)}}" alt="{{$item->nama_barang}}" width="100%" height="380px" />
                    </div>
                    <div id="change-thumbnail" style="display: none;">
                        <br />
                      <div class="">
                        <img id="preview-thumbnail" class="" src="{{url('images/thumbs/'. $thumb)}}" alt="" width="80%" height="380px" />
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
                        <h3 class="prod_title">{{$item->nama_barang}}</h3>
                        <div>
                            <p>{{$item->deskripsi_barang}}</p>
                        </div>
                        <br />
                        <div>
                            <div class="product_price">
                              <h1 class="price">{{$me->rp($item->harga_barang)}}</h1>
                              <span class="price-tax">{{$item->stok_barang}} Stok tersedia</span>
                            </div>
                        </div>
                        <br />
                        <div>
                            <input type="button" class="btn btn-default btn-primary btn-lg change" onclick="$('#view-description').toggle();$('#change-description').toggle(); $('#view-thumbnail').toggle();$('#change-thumbnail').toggle();" value="Ubah" >
                            <a href="{{url('items/delete/'. $item->kode_barang)}}" class="btn btn-default btn-danger btn-lg">Hapus</a>
                        </div>
                    </div>
                    <br />
                    <div id="change-description">
                        <form method="post" name="" action="{{url('items/change/'. $item->kode_barang)}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div>
                                <input name="name" class="form-control" type="text" placeholder="Nama Barang" value="{{$item->nama_barang}}" />
                            </div>
                            <br />
                            <div>
                                <textarea name="description" class="form-control" style="width: 100%; min-height: 200px;" rows="5">{{$item->deskripsi_barang}}</textarea>
                            </div>
                            <br />
                            <div>
                                <input name="price" class="form-control" type="number" min="0" placeholder="Harga Barang" value="{{$item->harga_barang}}" />
                            </div>
                            <br />
                            <div>
                                <input name="stock" class="form-control" type="number" min="0" placeholder="Stok Barang" value="{{$item->stok_barang}}" />
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
