@extends('katalog::layouts.app')
@push('styles')
<style type="text/css" media="screen">
    .top-control.top-control {
        background-color: #eee;
        padding: 10px 20px ;
        margin-bottom: 30px;
    }
</style>
@endpush
@section('content')
    <div class="main-content shop-page main-content-search-result">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset">
                    <div class="categories-content">
                        {{-- <h4 class="shop-title">We found 60 results for  “<span>Fashion</span>”</h4> --}}
                        {{-- <h3 class="sub-title">Related searches: <a href="#">clothing</a> , <a href="#">accessories</a> , <a href="#">handbags</a></h3> --}}
                        <div class="top-control box-has-content">
							<div class="control">
								<div class="filter-choice">
                                    <select data-placeholder="All Categories" class="chosen-select">
                                        <option value="1">Urutkan</option>
                                    </select>
                                </div>
                                <div class="select-item">
                                    <select data-placeholder="All Categories" class="chosen-select">
                                        <option value="1">Lokasi</option>
                                    </select>
                                </div>
                                <div class="select-item">
                                    <select data-placeholder="All Categories" class="chosen-select">
                                        <option value="1">Vendor</option>
                                    </select>
                                </div>
							</div>
						</div>
                        @if(count($product) == 0)
                        <div class="section-content" style="margin-bottom:54px;">
                            <div class="tab-content">
                                <div class="main-content shop-page page-404" width="100%">
                                    <img src="{{ asset('techone/images/icon/noproduct.png') }}" style="width:250px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                                    <h2 class="title">Maaf, tidak ada produk yang ditemukan </h2>
                                </div>
                            </div>
                        </div>
						@endif
                        <div class="section-content" style="margin-bottom:54px;">
                            <div class="tab-content">
                                <div id="tab1" class="tab-panel active">
                                    <div class="owl-carousel product-list-owl nav-style2 equal-container" data-dots="false" data-loop="false" data-slidespeed="800" data-margin="0"  data-responsive = '{"0":{"items":1}, "480":{"items":2,"margin":0}, "700":{"items":3,"margin":-1}, "768":{"items":2}, "1025":{"items":3}, "1200":{"items":4}, "1300":{"items":5}}'>
                                        @foreach($product->chunk(2) as $chunkProduct)
                                            <div class="row-item">
                                                @foreach($chunkProduct as $key => $d)
                                                <div class="product-item layout1">
                                                    <div class="product-inner equal-elem">
                                                        <div class="thumb">
                                                            <input type="hidden" name="description{{$key}}" id="description{{$key}}" value="{!! nl2br(e($d->product->short_description)) !!}"/>
                                                            <a class="quickview-button" onclick="quickview_popup('{{ $d->product_id }}', '{{ $code_url }}', '{{ $d->product->name }}', document.getElementById('description'+{{$key}}).value, @if($d->product->small_image == null) null @else '{{ $style->url_image }}{{ $d->product->small_image }}' @endif, 1, '{{ $d->price }}', '{{ $d->product->unit }}', '{{ $d->product->sku }}', '{{ $d->product->vendor_sku }}', '{{ $d->vendor->id }}', '{{ $d->vendor->vendor_name }}', '{{ $d->vendor->email }}')" >
                                                                <span class="icon">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                </span>
                                                                Ringkasan
                                                            </a>
                                                            <a @if(Auth::guest()) href="{{ route('guest.detail.product', $d->id) }}" @else href="{{ route('katalog.detail.product', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @endif class="thumb-link" style="margin:20px;">
                                                                @if($d->product->small_image != null)
                                                                {{-- <img src="{{ asset('/assets/product/'.$d->catalog_product_entity->catalog_product_entity_media_gallery[0]->value.'') }}" alt="" style="height:250px;"> --}}
                                                                <div style="width:150px; height:150px;">
                                                                    <img src="{{ $style->url_image }}{{ $d->product->small_image }}" style="width:150px; height:150px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                                                                </div>
                                                                @else
                                                                <div style="width:150px; height:150px;">
                                                                    <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="width:150px; height:150px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                                                                </div>
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="info">
                                                            <a class="product-name">{{ $d->product->name }}</a>
                                                            <div class="price">
                                                                <span>Rp. {{ number_format($d->price, 0) }}</span>
                                                            </div>
                                                            <div class="vendor">
                                                                <span>{{ $d->vendor->vendor_name }}</span>
                                                            </div>
                                                        </div>
                                                        @can('customer')
                                                        <div class="group-button">
                                                            <div class="inner">
                                                                <a class="btn btn-default" onclick="addtocart('{{ $d->product_id }}', '{{ $code_url }}', '{{ $d->product->name }}', @if($d->product->small_image == null) null @else '{{ $style->url_image }}{{ $d->product->small_image }}' @endif, 1, '{{ $d->price }}', '{{ $d->product->unit }}', '{{ $d->product->sku }}', '{{ $d->product->vendor_sku }}', '{{ $d->vendor->id }}', '{{ $d->vendor->vendor_name }}', '{{ $d->vendor->email }}')">
                                                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                                                </a>
                                                                <a class="btn btn-default"  onclick="addtocompare('{{ $d->product_id }}', '{{ $code_url }}', '{{ $d->product->name }}', @if($d->product->small_image == null) null @else '{{ $style->url_image }}{{ $d->product->small_image }}' @endif, 1, '{{ $d->price }}', '{{ $d->product->unit }}', '{{ $d->product->sku }}', '{{ $d->product->vendor_sku }}', '{{ $d->vendor->id }}', '{{ $d->vendor->vendor_name }}', '{{ $d->vendor->email }}')">
                                                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endcan
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! $product->appends(['search' => $search])->render() !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">
                    <div class="widget widget-categories">
                        <h5 class="widgettitle">Categories</h5>
                        <ul class="list-categories">
                        </ul>
                    </div>
                    <div class="widget widget-brand">
                        <h5 class="widgettitle">Brand</h5>
                        <ul class="list-categories">
                        </ul>
                    </div>
                    <div class="widget widget_filter_price box-has-content">
                        <h3 class="widgettitle">Filter by price</h3>
                        <div class="price-filter">
                        </div>
                    </div>
                    <div class="widget widget_filter_size">
                        <h3 class="widgettitle">size</h3>
                        <ul class="list-size">
                        </ul>
                    </div>
                    <div class="widget widget_filter_color box-has-content">
                        <h3 class="widgettitle">color</h3>
                        <ul class="list-color">
                        </ul>
                    </div>
                    <div class="widget widget-recent-post">
                        <h5 class="widgettitle">New Products</h5>
                        <ul class="list-recent-posts">
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
<script>
	function quickview_popup(product_id, code_url, name, description, image, qty, price, unit, sku, vendor_sku, vendor_id, vendor_name, vendor_email, key) {

		console.log(image);
		var html = `<div class="kt-popup-quickview">
						<div class="details-thumb col-xs-12 col-sm-6">`;
		if(image == null) {
			html += 		`<div style="height:250px;">
								<img src="{{ asset('/techone/images/product_placeholder.jpg') }}" style="height:200px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
							</div>`;
		} else {
			html += 		`<div style="width:250px;height:250px;">
								<img src="` + image + `" style="width:250px;height:250px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
							</div>`;
		}
		html += 		`</div>
						<div class="details-info col-xs-12 col-sm-6">
							<a class="product-name">
								`+name+`
							</a>
							<p class="description">
							`+description+`
							</p>
							<div class="price">
								<span >Rp.`+price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</span>
							</div>`;
		@can('customer')
		html += 			`<div class="group-button">
								<div class="inner">
									<a class="btn btn-default" onclick="addtocart('`+product_id+`', '`+code_url+`', '`+name+`', '`+image+`', '`+qty+`', '`+price+`', '`+unit+`', '`+sku+`', '`+vendor_sku+`', '`+vendor_id+`', '`+vendor_name+`', '`+vendor_email+`')">
										<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
									</a>
									<a class="btn btn-default" onclick="addtocompare('`+product_id+`', '`+code_url+`', '`+name+`', '`+image+`', `+qty+`, '`+price+`', '`+unit+`', '`+sku+`', '`+vendor_sku+`', '`+vendor_id+`', '`+vendor_name+`', '`+vendor_email+`')">
										<i class="fa fa-exchange" aria-hidden="true"></i>
									</a>
								</div>
							</div>`;
		@endcan
		html += 		`</div>
						<a onclick="tutupDialog()" class="kembali">Tutup</a>
					</div>`;

		Swal.fire({
			customClass: 'swal-wide',
			html: html,
			onOpen: function() {

			},
			showCancelButton: false,
			showConfirmButton: false
		})
	}

</script>
@endpush
