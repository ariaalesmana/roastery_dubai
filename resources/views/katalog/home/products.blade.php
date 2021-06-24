@if(count($product) == 0)
<div class="main-content shop-page page-404">
    <div class="container">
        <img src="{{ asset('techone/images/icon/noproduct.png') }}" style="width:250px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
        <h2 class="title">Maaf, tidak ada produk yang ditemukan </h2>
    </div>
</div>
@endif
<div class="row auto-clear box-has-content equal-container">
    @foreach($product->chunk(2) as $chunkProduct)
        @foreach($chunkProduct as $key => $d)
            <div class="product-item layout5 col-lg-4 col-md-6 col-sm-4 col-xs-6 col-ts-12">
                <div class="product-inner equal-elem ">
                    <div class="thumb ">
                        <a @if(Auth::guest()) href="{{ route('guest.detail.product', [$d->code, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @else href="{{ route('katalog.detail.product', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @endif class="quickview-button"><span class="icon"><i class="fa fa-eye" aria-hidden="true"></i></span> Quick View</a>
                        <input type="hidden" name="description{{$key}}" id="description{{$key}}" value="{!! nl2br(e($d->product->short_description)) !!}"/>
                        <a @if(Auth::guest()) href="{{ route('guest.detail.product', [$d->code, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @else href="{{ route('katalog.detail.product', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @endif class="thumb-link" style="margin:20px;">
                            <img src="{{asset(str_replace('public/files', 'storage/files', $d->product->small_image))}}" style="width:150px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;" alt=""></a>
                        </a>
                    </div>
                    <div class="info ">
                        <div class="inner">
                            <div class="rating">
                                <ul class="list-star">
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
                                </ul>
                                <span class="count">5 Review(s)</span>
                            </div>
                            <a @if(Auth::guest()) href="{{ route('guest.detail.product', [$d->code, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @else href="{{ route('katalog.detail.product', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($d->id)]) }}" @endif class="product-name">{{ $d->product->name }}</a>
                            <div class="price">
                                <span>Rp. {{ number_format($d->price, 0) }}</span>
                            </div>
                            <div class="vendor">
                                <span>{{ $d->vendor->vendor_name }}</span>
                            </div>
                            @can('customer')
                                <div class="group-button">
                                    <div class="inner">
                                        <a href="#" class="add-to-cart"><span class="text">ADD TO CART</span><span class="icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span></a>
                                        <a href="#" class="compare-button"><i class="fa fa-exchange" aria-hidden="true"></i></a>
                                        <a href="#" class="wishlist-button"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>
{!! $product->render() !!}