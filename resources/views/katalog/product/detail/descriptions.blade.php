<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset">
    <div class="about-product row">
        <div class="details-thumb col-xs-12 col-sm-6">
            @if($product_detail->product->small_image != null)
                <div style="width:400px; height:400px;" class="details-item">
                    {{-- <img style="width:400px; height:400px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;" src="{{ $style->url_image }}{{ $product_detail->product->small_image }}"> --}}
                    <img style="width:400px; height:400px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;" src="{{asset(str_replace('public/files', 'storage/files', $product_detail->product->small_image))}}">
                </div>
            @else
            <div style="width:400px; height:400px;">
                {{-- <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="width:350px; height:350px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;"> --}}
                <img src="{{ asset(str_replace('public/files', 'storage/files', $product_detail->product->image)) }}" style="width:350px; height:350px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
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
                {{-- <div class="group-quantity-button">
                    <a class="minus btn btn-default" onclick="qty('min')"><i class="fa fa-minus" aria-hidden="true"></i></a>
                    <input class="input-text qty text" id="qty" type="text" size="4" title="Qty" value="1" name="quantity">
                    <a class="plus btn btn-default" onclick="qty('plus')"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div> --}}
            </div>
            <div class="group-button">
                <div class="inner">
                    {{-- <a class="btn btn-default" onclick="addtocart('{{ $product_detail->product_id }}', '{{ $code_url }}', '{{ $product_detail->product->name }}', @if($product_detail->product->small_image == null) null @else '{{ $style->url_image }}{{ $product_detail->product->small_image }}' @endif, document.getElementById('qty').value, '{{ $product_detail->price }}', '{{ $product_detail->product->unit }}', '{{ $product_detail->product->sku }}', '{{ $product_detail->product->vendor_sku }}', '{{ $product_detail->vendor->id }}', '{{ $product_detail->vendor->vendor_name }}', '{{ $product_detail->vendor->email }}')">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-default" onclick="addtocompare('{{ $product_detail->product_id }}', '{{ $code_url }}', '{{ $product_detail->product->name }}', @if($product_detail->product->small_image == null) null @else '{{ $style->url_image }}{{ $product_detail->product->small_image }}' @endif, 1, '{{ $product_detail->price }}', '{{ $product_detail->product->unit }}', '{{ $product_detail->product->sku }}', '{{ $product_detail->product->vendor_sku }}', '{{ $product_detail->vendor->id }}', '{{ $product_detail->vendor->vendor_name }}', '{{ $product_detail->vendor->email }}')">
                        <i class="fa fa-exchange" aria-hidden="true"></i>
                    </a> --}}
                </div>
            </div>
            @endcan
        </div>
        @if(isset($product_detail->product->qrcode))
            <div class="details-info col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <img class="form-control" src="{{asset(str_replace('public/files', 'storage/files', $product_detail->product->qrcode))}}" style="width:150px; height:150px; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
            </div>
        @endif
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