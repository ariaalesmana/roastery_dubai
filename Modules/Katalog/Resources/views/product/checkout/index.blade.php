@extends('katalog::layouts.app')
@section('content')
<div class="main-content shop-page checkout-page">
    <div class="container">
        <div class="breadcrumbs">
            <a>Checkout</a>
        </div>
        <div class="row content-form">
            <form id="forms" method="post" action="{{ route('katalog.checkout.post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <div class="checkout-form content-form col-xs-12 col-sm-12 col-md-8 col-lg-9">
                    <ul class="group-changed parent-content">
                        <li class="changed-item">
                            <a class="changed-button active"></a>
                            <div class="info">
                                <h4 class="main-title">Form Order</h4>
                                <div class="des-changed show-content">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Nama Pekerjaan <span>*</span></span>
                                            <input type="text" class="form-control" name="nama_pekerjaan" id="nama_pekerjaan" value="{{ old('nama_pekerjaan') }}">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">No Purchase Requisition <span>*</span></span>
                                            <input type="text" class="form-control" name="no_pr" id="no_pr" value="{{ old('no_pr') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Nama Depan <span>*</span></span>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Nama Belakang <span>*</span></span>
                                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">	
                                        </div>
                                    </div>
                                    <span class="label-text">Nama Perusahaan <span>*</span></span>
                                    <input type="text" class="form-control" name="company" id="company" value="{{ old('company') }}">	
                                    <span class="label-text">Alamat <span>*</span></span>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <textarea rows="3" class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Kota <span>*</span></span>
                                            <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Provinsi <span>*</span></span>
                                            <input type="text" class="form-control" name="province" id="province" value="{{ old('province') }}">	
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Email <span>*</span></span>
                                            <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Kode Pos <span>*</span></span>
                                            <input type="text" class="form-control" name="postcode" id="postcode" value="{{ old('postcode') }}">	
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Nomor Telepon <span>*</span></span>
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">	
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <span class="label-text">Fax <span>*</span></span>
                                            <input type="text" class="form-control" name="fax" id="fax" value="{{ old('fax') }}">	
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="changed-item">
                            <a class="changed-button"></a>
                            <div class="info">
                                <h4 class="main-title">Pengiriman</h4>
                                <div class="des-changed">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                                            <div class="">
                                                <table class="shopping-cart-content table">
                                                    <tbody>
                                                    <?php $total = 0; ?>
                                                    @foreach ($cart['vendor']->distinct()->get() as $v)
                                                    <td colspan="5" style="text-align:left;vertical-align:middle;font-weight:bold;font-size:16px;background-color:#F9F7F6;" class="product-name" data-title="Product Name">
                                                        <span style="color:#555">
                                                            {{ $v->vendor_name }} - {{ $v->product_from }}
                                                        </span>
                                                        <input type="hidden" class="input-info" name="vendor_id" value="{{ $v->vendor_id }}">
                                                        <input type="hidden" class="input-info" name="vendor_name" value="{{ $v->vendor_name }}">
                                                        <input type="hidden" class="input-info" name="product_from" value="{{ $v->product_from }}">
                                                    </td>
                                                    @foreach ($cart['data']->get() as $d)
                                                        @if ($d->vendor_id == $v->vendor_id)
                                                        <?php $no = 0; ?>
                                                        <input type="hidden" class="input-info" name="cart_number" value="{{ $d->cart_number }}">
                                                        <tr class="each-item" id="rowqty{{ $d->id }}" style="border-bottom:none;line-height:30px;">
                                                            <td width="25%" style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                                                {{ $d->name }}
                                                            </td>
                                                            <td width="20%" style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" id="price{{ $d->id }}">
                                                                {{ number_format($d->price, 0) }}
                                                            </td>
                                                            <td width="25%" style="text-align:center;vertical-align:middle" class="quantity-item" data-title="Qty">
                                                                <div class="quantity">
                                                                    <div class="group-quantity-button">
                                                                        <input class="input-text qty text" id='qty{{ $d->id }}' type="text" size="4" title="Qty" value="{{ $d->qty }}" name="qty{{ $d->id }}" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" disabled>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <?php $subtotal = $d->price * $d->qty; ?>
                                                            <?php $total += $d->price * $d->qty; ?>
                                                            <td width="20%" style="text-align:right;vertical-align:middle" class="total" id="subtotal{{ $d->id }}" data-title="SubTotal">
                                                                {{ number_format($subtotal, 0) }}
                                                            </td>
                                                        </tr>
                                                        <tr style="border-top:none;border-bottom:none;">
                                                            <td colspan="5" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;background-color:white;" class="product-name" data-title="Product Name">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <fieldset class="form-group">
                                                                            <span class="label-text" style="font-weight: bold">Biaya Pengiriman</span>
                                                                            <div style="display: flex; justify-content: space-around;margin-top:16px;">
                                                                                <select class="custom-select val-custom form-control ongkir" name="{{ $d->id }}" id="ongkir{{ $d->id }}">
                                                                                    <option selected disabled>- Biaya Pengiriman -</option>
                                                                                    @foreach($d->cart_shipping()->get() as $cs)
                                                                                    <option value="{{$cs->price}}">
                                                                                        <span>{{ $cs->name }}</span> - <span style="color:#e5534c;">Rp. {{ number_format($cs->price, 0) }}</span>
                                                                                    </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="col-xl-12 col-md-12">
                                                                        <div id="rows{{$d->id}}">
                                                                                
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $no++; ?>
                                                        @endif
                                                    @endforeach
                                                        
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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
                            <div class="proceed-checkout">
                                <div class="content">
                                    <h5 class="title">Total Order</h5>
                                    <div class="info-checkout" style="display: none;">
                                        <span class="text">Sub Total : </span>
                                        <span class="item" id="granditem"><?= number_format($total, 0) ?></span>
                                    </div>
                                    <div class="total-checkout" style="border:none;">
                                        <span class="text" style="font-size: 16px;">Total </span>
                                        <input type="hidden" id="grandtotal_hide" name="grandtotal_hide" value="{{ $total }}"/>
                                        <span class="price" id="grandtotal">Rp. <?= number_format($total, 0) ?></span>
                                    </div>
                                    <div class="group-button">
                                        <button @if(count($cart['data']->get()) == 0) type="button" @else type="button" onclick="showPopUpDetailOrder();" @endif class="button submit">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="group-button-detail">
                                <a onclick="showPopUpDetailPemesanan();" style="cursor:pointer;" class="button submit">Lihat Detail Pemesanan</a>
                            </div>
                        </div>
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
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src='https://cdn.rawgit.com/hsnaydd/validetta/v1.0.1/dist/validetta.js'></script>
<script>

    @foreach ($errors->all() as $error)
        toastr.error("{{$error}}")
    @endforeach

    var $form = $("form"),
    $successMsg = $(".alert");

    $form.validetta({
        bubblePosition: "bottom",
        bubbleGapTop: 10,
        bubbleGapLeft: 5,
        onValid : function( event) {
            return true;
        },
        onError : function( event) {
            event.preventDefault();
        }
    });
    var dataProduct;

    <?php $jsonProduct = json_encode($cart['data']->get()); ?>
    dataProduct = {!! $jsonProduct !!};

    for(var i = 0; i < dataProduct.length; i++) {
        var index = dataProduct[i].id;

        $('#ongkir'+index).select2({
            allowClear: false,
            theme: 'bootstrap',
            width: "100%",
        });
    }
        
    $('.ongkir').bind("change",function() {
        var indexOngkir = $(this).attr('id');
        var index = $(this).attr('name');
        $(document).on('change','#'+indexOngkir,function() {
            var arraybiaya = [];
            var inpsBiaya = document.getElementsByName('biayatext'+index+'[]');
            for (var i = 0; i <inpsBiaya.length; i++) {
                var inpBiaya = inpsBiaya[i];
                arraybiaya[i] = inpBiaya.value;
            }

            var cek = arraybiaya.includes(this.options[this.selectedIndex].text);
            console.log(arraybiaya);
            
            if(!cek && this.options[this.selectedIndex].text != '- Biaya Pengiriman -') {
                
                $('#rows'+index).append(`<div class="row">
                                    <div class="col-md-11" style="margin-top:10px;">
                                        <div class="row">
                                            <input type="hidden" name="biayavalue`+index+`[]" id="biayavalue`+index+`[]" value="` + $(this).find("option:selected").attr('value') + `">
                                            <input type="hidden" name="biayatext`+index+`[]" id="biayatext`+index+`[]" value="` + this.options[this.selectedIndex].text + `">
                                            <div class="col-sm-12">
                                                <div class="input-container">
                                                    <div class="floating-form">
                                                        <div class="floating-label">
                                                            <input class="floating-input" type="hidden">
                                                            <span class="highlight"></span>
                                                            <input disabled type="text" autocomplete="off" tabindex="-1" class="form-control-2" style="width:100%;" name="biaya`+index+`[]" id="biaya`+index+`[]" data-validetta="required" value="` + this.options[this.selectedIndex].text + `">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1" id="remove">
                                        <button class="btn btn-danger" style="margin-top:10px;">
                                            <i class="fa fa-trash-o" style="color:white;"></i>
                                        </button>
                                    </div>
                                </div>`);

                var shipping_price = parseInt($(this).find("option:selected").attr('value'));
                var grandtotal = parseInt(document.getElementById("grandtotal_hide").value);
                
                var count_total = shipping_price + grandtotal;

                document.getElementById("grandtotal_hide").value = count_total;
                document.getElementById("grandtotal").innerHTML = "Rp. " + count_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                $('#'+indexOngkir+' option:first').prop('selected',true);
                $('#'+indexOngkir).prop('selectedIndex',0);

                $('#rows'+index).on("click","#remove", function(e) {
                    e.preventDefault(); 
                    $(this).parent('div').remove();

                    <?php $jsontotal = json_encode($total); ?>
                    var total = {!! $jsontotal !!};
                    var totals = 0;
                    
                    var inpsBiaya = document.getElementsByName('biayavalue[]');

                    for (var i = 0; i <inpsBiaya.length; i++) {
                        var inpBiaya = inpsBiaya[i];
                        totals += parseInt(inpBiaya.value);
                    }
                    
                    total_all = parseInt(total) + parseInt(totals);
                    document.getElementById("grandtotal_hide").value = total_all;
                    document.getElementById("grandtotal").innerHTML = "Rp. " + total_all.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                    var g = document.getElementById('rows'+index);
                    for (var i = 0, len = g.children.length; i < len; i++) {
                        (function(index){
                            g.children[i].onclick = function() {
                            }    
                        })(i);
                    }
                })
            }
        });
    });
    

    function showPopUpDetailPemesanan() {
        var html = 
        `<div class="row content-form" style="padding:10px;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                <div class="table-responsive">
                    <table class="shopping-cart-content table table-striped table-scroll small-first-col">
                        <thead>
                            <tr>
                                <th class="text-center" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-thumb"></td>
                                <th class="text-center" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Nama Produk</td>
                                <th class="text-center" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="price">Harga Satuan</td>
                                <th class="text-center" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="quantity-item">Jumlah</td>	
                                <th class="text-center" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="total">SubTotal</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0; ?>
                        @foreach ($cart['vendor']->distinct()->get() as $v)
                        <td colspan="5" style="text-align:left;vertical-align:middle;background-color:#F9F7F6;" class="product-name" data-title="Product Name">
                            <a class="product-name" style="color:#555; font-weight:bold">
                                {{ $v->vendor_name }} - {{ $v->product_from }}
                            </a>
                        </td>
                        @foreach ($cart['data']->get() as $d)
                            @if ($d->vendor_id == $v->vendor_id)
                            <?php $no = 0; ?>
                            <tr class="each-item" id="rowqty{{ $d->id }}">
                                <td width="20%" class="product-thumb">
                                    @if($d->image == null)
                                    <div style="height:70px;width:70px;">
                                        <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="width:70px;height:70px;">
                                    </div>
                                    @else
                                    <div style="height:70px;width:70px;">
                                        <img src="{{ $d->image }}" style="width:70px;height:70px;">
                                    </div>
                                    @endif
                                </td>
                                <td width="25%" style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $d->name }}
                                    </a>
                                </td>
                                <td width="20%" style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" id="price{{ $d->id }}">
                                    {{ number_format($d->price, 0) }}
                                </td>
                                <td width="25%" style="text-align:center;vertical-align:middle" class="quantity-item" data-title="Qty">
                                    <div class="quantity">
                                        <div class="group-quantity-button">
                                            <input class="input-text qty text" id='qty{{ $d->id }}' type="text" size="4" title="Qty" value="{{ $d->qty }}" name="qty{{ $d->id }}" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" disabled>
                                        </div>
                                    </div>
                                </td>
                                <?php $subtotal = $d->price * $d->qty; ?>
                                <?php $total += $d->price * $d->qty; ?>
                                <td width="20%" style="text-align:right;vertical-align:middle" class="total" id="subtotal{{ $d->id }}" data-title="SubTotal">
                                    {{ number_format($subtotal, 0) }}
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @endif
                        @endforeach
                            
                        @endforeach
                        </tbody>
                        <tfoot style="display:block;width:100%;">
                            <tr style="margin-top:36px;">
                                <td width="5%" style="font-size:14px;color:#555;font-weight:bold;" align="right" colspan="3">Total</td>
                                <td width="90%" class="total" style="text-align:right;" colspan="2">Rp. {{ number_format($total, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>`;
		$("#detail-checkout-modal .modal-content .modal-body").html(html);
		$("#detail-checkout-modal").modal('show');
    }

    function showPopUpDetailOrder() {
        if(document.getElementById('nama_pekerjaan').value == '') {
            toastr.error('Isi nama pekerjaan', 'Informasi!')
        } else if(document.getElementById('no_pr').value == '') {
            toastr.error('Isi nomor PR', 'Informasi!')
        } else if(document.getElementById('first_name').value == '') {
            toastr.error('Isi nama depan', 'Informasi!')
        } else if(document.getElementById('last_name').value == '') {
            toastr.error('Isi nama belakang', 'Informasi!')
        } else if(document.getElementById('company').value == '') {
            toastr.error('Isi nama perusahaan', 'Informasi!')
        } else if(document.getElementById('address').value == '') {
            toastr.error('Isi alamat', 'Informasi!')
        } else if(document.getElementById('city').value == '') {
            toastr.error('Isi kota', 'Informasi!')
        } else if(document.getElementById('province').value == '') {
            toastr.error('Isi provinsi', 'Informasi!')
        } else if(document.getElementById('email').value == '') {
            toastr.error('Isi email', 'Informasi!')
        } else if(document.getElementById('postcode').value == '') {
            toastr.error('Isi kode pos', 'Informasi!')
        } else if(document.getElementById('phone').value == '') {
            toastr.error('Isi nomor telepon', 'Informasi!')
        } else if(document.getElementById('fax').value == '') {
            toastr.error('Isi fax', 'Informasi!')
        } else {
            var html = 
            `<div class="row content-form" style="padding:10px;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                    <ul class="group-changed parent-content">
                        <li class="changed-item">
                            <a class="changed-button active"></a>
                            <div class="info">
                                <h4 class="main-title">Form Order</h4>
                                <div class="des-changed show-content">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Nama Pekerjaan <span>*</span></span>
                                            <input type="text" class="form-control" name="nama_pekerjaan" value="`+document.getElementById('nama_pekerjaan').value+`" disabled>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">No Purchase Requisition <span>*</span></span>
                                            <input type="text" class="form-control" name="no_pr" value="`+document.getElementById('no_pr').value+`" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Nama Depan <span>*</span></span>
                                            <input type="text" class="form-control" name="first_name" value="`+document.getElementById('first_name').value+`" disabled>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Nama Belakang <span>*</span></span>
                                            <input type="text" class="form-control" name="last_name" value="`+document.getElementById('last_name').value+`" disabled>	
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
                                            <span class="label-text">Nama Perusahaan <span>*</span></span>
                                            <input type="text" class="form-control"name="company" value="`+document.getElementById('company').value+`" disabled>	
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-left">
                                            <span class="label-text">Alamat <span>*</span></span>
                                            <textarea rows="3" class="form-control" name="address" disabled>`+document.getElementById('address').value+`</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Kota <span>*</span></span>
                                            <input type="text" class="form-control" name="city" value="`+document.getElementById('city').value+`" disabled>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Provinsi <span>*</span></span>
                                            <input type="text" class="form-control" name="province" value="`+document.getElementById('province').value+`" disabled>	
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Email <span>*</span></span>
                                            <input type="text" class="form-control" name="email" value="`+document.getElementById('email').value+`" disabled>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Kode Pos <span>*</span></span>
                                            <input type="text" class="form-control" name="postcode" value="`+document.getElementById('postcode').value+`" disabled>	
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Nomor Telepon <span>*</span></span>
                                            <input type="text" class="form-control" name="phone" value="`+document.getElementById('phone').value+`" disabled>	
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-left">
                                            <span class="label-text">Fax <span>*</span></span>
                                            <input type="text" class="form-control" name="fax" value="`+document.getElementById('fax').value+`" disabled>	
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="changed-item">
                            <a class="changed-button"></a>
                            <div class="info">
                                <h4 class="main-title">Pengiriman</h4>
                                <div class="des-changed">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                                            <div class="">
                                                <table class="shopping-cart-content table">
                                                    <tbody>
                                                    <?php $total = 0; ?>
                                                    @foreach ($cart['vendor']->distinct()->get() as $v)
                                                    <td colspan="5" style="text-align:left;vertical-align:middle;font-weight:bold;font-size:16px;background-color:#F9F7F6;" class="product-name" data-title="Product Name">
                                                        <span style="color:#555">
                                                            {{ $v->vendor_name }} - {{ $v->product_from }}
                                                        </span>
                                                        <input type="hidden" class="input-info" name="vendor_id" value="{{ $v->vendor_id }}">
                                                        <input type="hidden" class="input-info" name="vendor_name" value="{{ $v->vendor_name }}">
                                                        <input type="hidden" class="input-info" name="product_from" value="{{ $v->product_from }}">
                                                    </td>
                                                    @foreach ($cart['data']->get() as $d)
                                                        @if ($d->vendor_id == $v->vendor_id)
                                                        <?php $no = 0; ?>
                                                        <input type="hidden" class="input-info" name="cart_number" value="{{ $d->cart_number }}">
                                                        <tr class="each-item" id="rowqty{{ $d->id }}" style="border-bottom:none;line-height:30px;">
                                                            <td width="25%" style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                                                {{ $d->name }}
                                                            </td>
                                                            <td width="20%" style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" id="price{{ $d->id }}">
                                                                {{ number_format($d->price, 0) }}
                                                            </td>
                                                            <td width="25%" style="text-align:center;vertical-align:middle" class="quantity-item" data-title="Qty">
                                                                <div class="quantity">
                                                                    <div class="group-quantity-button">
                                                                        <input class="input-text qty text" id='qty{{ $d->id }}' type="text" size="4" title="Qty" value="{{ $d->qty }}" name="qty{{ $d->id }}" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" disabled>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <?php $subtotal = $d->price * $d->qty; ?>
                                                            <?php $total += $d->price * $d->qty; ?>
                                                            <td width="20%" style="text-align:right;vertical-align:middle" class="total" id="subtotal{{ $d->id }}" data-title="SubTotal">
                                                                {{ number_format($subtotal, 0) }}
                                                            </td>
                                                        </tr>
                                                        <tr style="border-top:none;border-bottom:none;">
                                                            <td colspan="5" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;background-color:white;" class="product-name" data-title="Product Name">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <fieldset class="form-group">
                                                                            <span class="label-text" style="font-weight: bold">Biaya Pengiriman</span>
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="col-xl-12 col-md-12">
                                                                        `+document.getElementById('rows{{$d->id}}').innerHTML+`
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $no++; ?>
                                                        @endif
                                                    @endforeach
                                                        
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>`
            $("#detail-order-modal .modal-content .modal-body").html(html);
            $("#detail-order-modal").modal('show');
        }
    }

    function checkout() {
        document.getElementById("forms").submit();
    }
</script>
@endpush