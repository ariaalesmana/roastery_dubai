@extends('katalog::layouts.app')
@section('content')
<div class="main-content shop-page main-content-detail">
    <div class="container">
        <div class="breadcrumbs">
            <a>Perbandingan Produk</a>
        </div>
        <div class="row content-form">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 content-offset">
                <div class="table-responsive">
                    <table id="compare" class="shopping-cart-content table table-striped table-scroll small-first-col">
                        <thead>
                            <tr>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-thumb"></td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Nama Produk</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="price">Harga Satuan</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="delete-item"></td>
                            </tr>
                        </thead>
                        <tbody class="body-half-screen">
                            @foreach ($data->get() as $key => $d)
                            <?php $no = 0; ?>
                            <tr class="each-item" id="rowqty{{ $d->id }}">
                                <td class="product-thumb">
                                    @if($d->image == null)
                                    <div style="height:120px;width:120px;">
                                        <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="width:120px;height:120px;">
                                    </div>
                                    @else
                                    <div style="height:120px;width:120px;">
                                        <img src="{{ $d->image }}" style="width:120px;height:120px;">
                                    </div>
                                    @endif
                                </td>
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $d->name }}
                                    </a>
                                </td>
                                <td style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" id="price{{ $d->id }}">
                                    Rp.{{ number_format($d->price, 0) }}
                                </td>
                                <td style="text-align:center;vertical-align:middle" class="icon" data-title="Remove">
                                    <input type="hidden" name="description{{$key}}" id="description{{$key}}" value="{!! nl2br(e($d->description)) !!}"/>
                                    <a style="vertical-align:middle;" class="btn btn-default" onclick="addtocart('{{ $d->product_id }}', '{{ $d->product_from }}', '{{ $d->name }}', document.getElementById('description'+{{$key}}).value, '{{ $d->image }}', 1, '{{ $d->price }}', '{{ $d->unit }}', '{{ $d->sku }}', '{{ $d->vendor_sku }}', '{{ $d->vendor_id }}', '{{ $d->vendor_name}}', '{{ $d->vendor_email }}')">
                                        <i class="fa fa-cart-arrow-down"></i>
                                    </a>
                                    <a style="vertical-align:middle;" class="btn btn-danger" onclick="showAlert('{{ $d->id }}',' {{ $no }}')">
                                        <i class="fa fa-trash-o" style="color:white"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($data->get()) == 0)
                <div class="main-content shop-page page-404">
                    <div>
                        <img src="{{ asset('techone/images/icon/noproduct.png') }}" style="width:250px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                        <h2 class="title">Maaf, tidak ada produk dalam perbandingan </h2>
                    </div>
                </div>
                @endif
                <div class="table-responsive" style="border:none;">
                    <table class="shopping-cart-content">
                        <thead>
                        </thead>
                        <tbody>
                        <tr class="checkout-cart group-button">
                            <td colspan="6" class="left">
                                <div class="left">
                                    <a href="{{ route('katalog.index') }}" class="continue-shopping submit">Lanjutkan Belanja</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 ">
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
                                <div class="col-md-5">
                                    <ul class="list-socials">
                                        <li><a><i class="fa fa-facebook" aria-hidden="true">&nbsp;&nbsp;&nbsp;Facebook</i></a></li>
                                        <li><a><i class="fa fa-twitter" aria-hidden="true">&nbsp;&nbsp;&nbsp;Twitter</i></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-7">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function addtocart(product_id, code_url, name, description, image, qty, price, unit, sku, vendor_sku, vendor_id, vendor_name, vendor_email) {
        $('.modal-loading').modal('show');
		$.ajax({
			type : 'GET',
			url : '{{ route('katalog.cart.add', [Auth::user()->group->code]) }}',
			data : {
				product_id : product_id,
                product_from : code_url,
				name : name,
				description	: description,
				image : image,
				qty : qty,
				price : price,
				unit : unit,
				sku : sku,
				vendor_sku : vendor_sku,
				vendor_id : vendor_id,
				vendor_name : vendor_name,
				vendor_email : vendor_email
			},
			success:function(response){	
				response = JSON.parse(response);
				calculatecart();
				showPopUpCart();
			}
		});
    }

    function showAlert(id, idarr) {
        var html = 
        `<div style="z-index:9999999;padding:0;margin:0;">
            <div class="modal-dialog modal-sm modal-primary" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Informasi</h4>
                    </div>
                    <div class="modal-body">
                        <h5>
                            Apakah anda yakin akan menghapus item ?
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button id="tutupSwal" class="btn btn-sm btn-danger float-right">Tutup</button>
                        <button id="hapusSwal" class="btn btn-sm btn-danger float-right">Hapus</button>
                    </div>
                </div>
            </div>
        </div>`;
        
        Swal.fire({
            customClass: 'swal-wide-register',
            html: html,
            onOpen: function() {
                $('#tutupSwal').click(function(){
                    swal.close();
                });
                $('#hapusSwal').click(function(){
                    removecomparison(id, idarr)
                });
            },
            showCancelButton: false,
            showConfirmButton: false
        })
    }

    function removecomparison(id, idarr) {
        tutupDialog();
        $.ajax({
            type:'GET',
            url : '{{ route('katalog.comparison.delete', [Auth::user()->group->code]) }}',
            data:{
                idcomparison: id
            },
            success:function(response) {
                var htmlrowqty = "#rowqty"+id;
                $(htmlrowqty).remove();
                calculatecomparison();
                history.go(0);
            }
        });
    }
</script>
@endpush