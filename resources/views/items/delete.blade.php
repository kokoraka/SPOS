@extends('layouts.main')

@section('title', 'SPOS - Hapus')

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
            <h2>Hapus Data {{$item->nama_barang}}?</h2>
            <div class="clearfix"></div>

            <div class="x_content">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="product-image" style="padding: 15px;">
                        @php ($thumb = $item->gambar_barang)
                        @if (!$thumb) @php ($thumb = 'default.jpg') @endif
                        <img src="{{url('images/thumbs/'. $thumb)}}" alt="{{$item->nama_barang}}" style="width:200px; height:200px;" />
                    </div>
                    <div class="product_gallery">

                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12" style="border:0px solid #e5e5e5;">
                    <div id="view-description">
                      <form method="post" name="" action="{{url('items/delete/'. $item->kode_barang)}}">
                         {{ csrf_field() }}
                        <br />
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
                            <a href="{{url('items/')}}" class="btn btn-default btn-default btn-lg">Kembali</a>
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
