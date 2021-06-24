@extends('katalog.layouts.app_company')
@section('content')
	<div class="main-content home-page main-content-home2">
		<div class="container">
			<div class="container-offset">
				<div class="row">
					<div class="col-lg-4 col-md-5 col-sm-12 left-content">
						<div class="row">
							<div class="col-md-12">
								<div class="featrue-item">
									<div class="featrue-box layout2 equal-elem">
										<div class="block-icon"><a><span class="fa fa-life-ring"></span></a></div>
										<div class="block-inner">
											<a class="title">Online support 24/7</a>
											<p class="des">Online support 24/7</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<ul class="list-socials">
									<li><a><i class="fa fa-facebook" aria-hidden="true">&nbsp;&nbsp;&nbsp;Facebook</i></a></li>
									<li><a><i class="fa fa-twitter" aria-hidden="true">&nbsp;&nbsp;&nbsp;Twitter</i></a></li>
								</ul>
							</div>
							<div class="col-md-6">
								<ul class="list-socials">
									<li><a><i class="fa fa-phone" aria-hidden="true">&nbsp;&nbsp;&nbsp;(021)22737851</i></a></li>
									<li><a><i class="fa fa-envelope" aria-hidden="true">&nbsp;&nbsp;&nbsp;cs@inamart.co.id</i></a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12 col-ts-12 middle-content container-vertical-wapper">
						<div class="main-slideshow slideshow3">
							<div class="owl-carousel nav-style1 owl-background" data-autoplay="true" data-nav="true" data-dots="false" data-loop="true" data-slidespeed="800" data-margin="0"  data-responsive = '{"0":{"items":1}, "640":{"items":1}, "768":{"items":1}, "1024":{"items":1}, "1200":{"items":1}}' data-height="400">
								<div class="slide-item item1 item-background" data-background="{{ asset('techone/images/home_slideshow/test1.jpg') }}">
									<div class="slide-img">
										<img src="{{ asset('techone/images/home_slideshow/test1.jpg') }}" alt="">
									</div>
								</div>
								<div class="slide-item item2 item-background" data-background="{{ asset('techone/images/home_slideshow/test2.jpg') }}">
									<div class="slide-img">
										<img src="{{ asset('techone/images/home_slideshow/test2.jpg') }}" alt="">
									</div>
								</div>
								<div class="slide-item item3 item-background" data-background="{{ asset('techone/images/home_slideshow/test3.jpg') }}">
									<div class="slide-img">
										<img src="{{ asset('techone/images/home_slideshow/test3.jpg') }}" alt="">
									</div>
								</div>
								<div class="slide-item item3 item-background" data-background="{{ asset('techone/images/home_slideshow/test4.jpg') }}">
									<div class="slide-img">
										<img src="{{ asset('techone/images/home_slideshow/test4.jpg') }}" alt="">
									</div>
								</div>
								<div class="slide-item item3 item-background" data-background="{{ asset('techone/images/home_slideshow/test5.jpg') }}">
									<div class="slide-img">
										<img src="{{ asset('techone/images/home_slideshow/test5.jpg') }}" alt="">
									</div>
								</div>
								<div class="slide-item item3 item-background" data-background="{{ asset('techone/images/home_slideshow/test6.jpg') }}">
									<div class="slide-img">
										<img src="{{ asset('techone/images/home_slideshow/test6.jpg') }}" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="right-content-offset col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="group-product layout1">
						<div class="kt-tab nav-tab-style1">
							<div class="section-head box-has-content" style="z-index:2">
								<h4 class="section-title">Produk</h4>
								<ul class="nav list-nav">
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
								</ul>
							</div>
							@if(count($product) == 0)
							<div class="main-content shop-page page-404">
								<div class="container">
									<img src="{{ asset('techone/images/icon/noproduct.png') }}" style="width:250px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
									<h2 class="title">Maaf, tidak ada produk yang ditemukan </h2>
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
																<a class="quickview-button" onclick="quickview_popup('{{ $d->product_id }}', '{{ $code_url }}', '{{ $d->product->name }}', document.getElementById('description'+{{$key}}).value, @if($d->product->small_image == null) null @else '{{ $style->url_image }}{{ $d->product->small_image }}' @endif, 1, '{{ $d->price }}', '{{ $d->product->unit }}', '{{ $d->product->sku }}', '{{ $d->product->vendor_sku }}', '{{ $d->vendor->id }}', '{{ $d->vendor->title }}', '{{ $d->vendor->email }}')" >
																	<span class="icon">
																		<i class="fa fa-eye" aria-hidden="true"></i>
																	</span> 
																	Ringkasan
                                                                </a>
																<a href="{{ route('company.detail.product',[$modules, $d->id]) }}" class="thumb-link" style="margin:20px;">
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
																	<span>{{ $d->vendor->title }}</span>
																</div>
															</div>
															@can('customer')
															<div class="group-button">
																<div class="inner">
																	<a class="btn btn-default" onclick="addtocart('{{ $d->product_id }}', '{{ $code_url }}', '{{ $d->product->name }}', @if($d->product->small_image == null) null @else '{{ $style->url_image }}{{ $d->product->small_image }}' @endif, 1, '{{ $d->price }}', '{{ $d->product->unit }}', '{{ $d->product->sku }}', '{{ $d->product->vendor_sku }}', '{{ $d->vendor->id }}', '{{ $d->vendor->title }}', '{{ $d->vendor->email }}')">
																		<i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
																	</a>
																	<a class="btn btn-default"  onclick="addtocompare('{{ $d->product_id }}', '{{ $code_url }}', '{{ $d->product->name }}', @if($d->product->small_image == null) null @else '{{ $style->url_image }}{{ $d->product->small_image }}' @endif, 1, '{{ $d->price }}', '{{ $d->product->unit }}', '{{ $d->product->sku }}', '{{ $d->product->vendor_sku }}', '{{ $d->vendor->id }}', '{{ $d->vendor->title }}', '{{ $d->vendor->email }}')">
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
							{!! $product->render() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
<script>
	function quickview_popup(product_id, code_url, name, description, image, qty, price, unit, sku, vendor_sku, vendor_id, vendor_name, vendor_email, key) {

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