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
                                <a @if(Auth::guest()) href="{{ route('guest.detail.product', [$d->code, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @else href="{{ route('katalog.detail.product', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @endif>
                                    @if($d->product->small_image != null)
                                        <div style="height:80px;width:80px;">
                                            {{-- <img src="{{ $style->url_image }}{{ $d->product->small_image }}" style="height:80px; width:80px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;"> --}}
                                            <img src="{{ asset(str_replace('public/files', 'storage/files', $d->product->small_image)) }}" style="height:80px; width:80px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                                        </div>
                                    @else
                                        {{-- <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="height:80px;width:80px;"> --}}
                                        <img src="{{ asset(str_replace('public/files', 'storage/files', $d->product->thumnail)) }}" style="height:80px;width:80px;">
                                    @endif
                                </a>
                            </div>
                            <div class="info">
                                <a @if(Auth::guest()) href="{{ route('guest.detail.product', [$d->code, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @else href="{{ route('katalog.detail.product', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @endif class="product-name">{{ $d->product->name }}</a>
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