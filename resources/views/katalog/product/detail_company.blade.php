@extends('katalog.layouts.app_company')
@section('content')
<div class="main-content shop-page main-content-detail">
    <div class="container">
        <div class="breadcrumbs">
            <a>Detail Produk</a>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset">
                <div class="about-product row">
                    <div class="details-thumb col-xs-12 col-sm-6">
                        @if($product_detail->product->small_image != null)
                        <div style="width:400px; height:400px;" class="details-item">
                            <img style="width:400px; height:400px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;" src="{{ $style->url_image }}{{ $product_detail->product->small_image }}">
                        </div>
                        @else
                        <div style="width:400px; height:400px;">
                            <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="width:350px; height:350px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                        </div>
                        @endif
                    </div>
                    <div class="details-info col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <a class="product-name">{!! $product_detail->product->name !!}</a>
                        <p class="description">
                            <input type="hidden" name="description" id="description" value="{!! nl2br(e($product_detail->product->short_description)) !!}"/>
                            {!! nl2br(e($product_detail->product->short_description)) !!}
                        </p>
                        <div class="availability">Ketersediaan : <a>Tersedia</a></div>
                        <div class="price">
                            <span >Rp. {{ number_format($product_detail->price, 0) }}</span>
                        </div>
                        <p class="description">
                            SKU : {{ $product_detail->product->sku }}<br>
                            Vendor SKU : {{ $product_detail->product->vendor_sku }}
                        </p>

                        @can('customer')
                        <div class="quantity">
                            <div class="group-quantity-button">
                                <a class="minus btn btn-default" onclick="qty('min')"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                <input class="input-text qty text" id="qty" type="text" size="4" title="Qty" value="1" name="quantity">
                                <a class="plus btn btn-default" onclick="qty('plus')"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="group-button">
                            <div class="inner">
                                <a class="btn btn-default" onclick="addtocart('{{ $product_detail->product_id }}', '{{ $code_url }}', '{{ $product_detail->product->name }}', @if($product_detail->product->small_image == null) null @else '{{ $style->url_image }}{{ $product_detail->product->small_image }}' @endif, document.getElementById('qty').value, '{{ $product_detail->price }}', '{{ $product_detail->product->unit }}', '{{ $product_detail->product->sku }}', '{{ $product_detail->product->vendor_sku }}', '{{ $product_detail->vendor->id }}', '{{ $product_detail->vendor->title }}', '{{ $product_detail->vendor->email }}')">
                                    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-default" onclick="addtocompare('{{ $product_detail->product_id }}', '{{ $code_url }}', '{{ $product_detail->product->name }}', @if($product_detail->product->small_image == null) null @else '{{ $style->url_image }}{{ $product_detail->product->small_image }}' @endif, 1, '{{ $product_detail->price }}', '{{ $product_detail->product->unit }}', '{{ $product_detail->product->sku }}', '{{ $product_detail->product->vendor_sku }}', '{{ $product_detail->vendor->id }}', '{{ $product_detail->vendor->title }}', '{{ $product_detail->vendor->email }}')">
                                    <i class="fa fa-exchange" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        @endcan
                    </div>
                </div>
                
                <div class="kt-tab nav-tab-style2">
                    <ul class="nav list-nav">
                        <li class="active"><a data-animated="fadeIn" data-toggle="pill" href="#tab1">Deskripsi</a></li>
                        <li><a data-animated="zoomInUp" data-toggle="pill" href="#tab2">Informasi Tambahan</a></li>
                    </ul>						
                    <div class="tab-content">
                        <div id="tab1" class="tab-panel active ">
                            <div class="description">
                                <p>
                                    {!! nl2br(e($product_detail->product->description)) !!}
                                </p>
                            </div>
                        </div>
                        <div id="tab2" class="tab-panel">
                            <div class="additional">
                                <p>
                                    {!! nl2br(e($product_detail->product->short_description)) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="equal-container widget-featrue-box">
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
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true">&nbsp;&nbsp;&nbsp;Facebook</i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true">&nbsp;&nbsp;&nbsp;Twitter</i></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-socials">
                                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true">&nbsp;&nbsp;&nbsp;(021)22737851</i></a></li>
                                        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true">&nbsp;&nbsp;&nbsp;cs@inamart.co.id</i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-banner row-banner">
                            <div class="banner banner-effect1">
                                <a><img src="images/banner23.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="widget widget-bestseller">
                            <h5 class="widgettitle">{{ count($related_product) }} Produk Terkait</h5>
                            <div class="owl-carousel nav-style2" data-autoplay="false" data-nav="false" data-dots="false" data-loop="false" data-slidespeed="800" data-margin="30"  data-responsive = '{"0":{"items":1},"480":{"items":1}, "768":{"items":1}, "1024":{"items":1}, "1200":{"items":1}}'>
                                @foreach($related_product->chunk(5) as $chunkProduct)
                                <ul class="list-recent-posts">
                                    @foreach($chunkProduct as $key => $d)
                                    <li class="product-item">
                                        <div class="thumb">
                                            <a @if(Auth::guest()) href="{{ route('guest.detail.product', $d->id) }}" @else href="{{ route('company.detail.product', [$modules, $d->id]) }}" @endif>
                                                @if($d->product->small_image != null)
                                                <div style="height:80px;width:80px;">
                                                    <img src="{{ $style->url_image }}{{ $d->product->small_image }}" style="height:80px; width:80px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                                                </div>
                                                @else
                                                <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="height:80px;width:80px;">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="info">
                                            <a @if(Auth::guest()) href="{{ route('guest.detail.product', $d->id) }}" @else href="{{ route('company.detail.product', [$modules, $d->id]) }}" @endif class="product-name">{{ $d->product->name }}</a>
                                            <div class="price">
                                                <span>Rp. {{ number_format($d->price, 0) }}</span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="kembali" href="{{ url()->previous() }}">Kembali</a>
    </div>
</div>
@endsection
@push('scripts')
<script>
    
</script>
@endpush