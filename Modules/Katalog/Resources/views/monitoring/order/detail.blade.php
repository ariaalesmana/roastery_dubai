@extends('katalog::layouts.app')
@section('content')
<div class="main-content shop-page checkout-page">
    <div class="container">
        <div class="breadcrumbs">
            <a>Detail Order</a>
        </div>
        <div class="row content-form">
            <div class="checkout-form content-form col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <ul class="group-changed parent-content">
                    <li class="changed-item">
                        <a class="changed-button active"></a>
                        <div class="info">
                            <h4 class="main-title">Detail Order</h4>
                            <div class="des-changed show-content">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Nama Pekerjaan <span>*</span></span>
                                        <input type="text" class="form-control" name="nama_pekerjaan" data-validetta="required" data-vd-message-required="Isi Nama Pekerjaan" value="{{ $order->name }}" disabled>	
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">No Purchase Requisition <span>*</span></span>
                                        <input type="text" class="form-control" name="no_pr" data-validetta="required" data-vd-message-required="Isi Nomor PR" value="{{ $order->no_pr }}" disabled>	
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Nama Depan <span>*</span></span>
                                        <input type="text" class="form-control" name="first_name" data-validetta="required" data-vd-message-required="Isi Nama Depan" value="{{ $order->order_address->first_name }}" disabled>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Nama Belakang <span>*</span></span>
                                        <input type="text" class="form-control" name="last_name" data-validetta="required" data-vd-message-required="Isi Nama Belakang" value="{{ $order->order_address->last_name }}" disabled>	
                                    </div>
                                </div>
                                <span class="label-text">Nama Perusahaan <span>*</span></span>
                                <input type="text" class="form-control" name="company" data-validetta="required" data-vd-message-required="Isi Nama Perusahaan" value="{{ $order->order_address->company }}" disabled>	
                                <span class="label-text">Alamat <span>*</span></span>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <textarea rows="3" class="form-control" name="address" data-validetta="required" data-vd-message-required="Isi Alamat" disabled>{{ $order->order_address->address }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Kota <span>*</span></span>
                                        <input type="text" class="form-control" name="city" data-validetta="required" data-vd-message-required="Isi Nama Kota" value="{{ $order->order_address->city }}" disabled>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Provinsi <span>*</span></span>
                                        <input type="text" class="form-control" name="province" data-validetta="required" data-vd-message-required="Isi Nama Provinsi" value="{{ $order->order_address->province }}" disabled>	
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Email <span>*</span></span>
                                        <input type="text" class="form-control" name="email" data-validetta="required" data-vd-message-required="Isi Email" value="{{ $order->order_address->email }}" disabled>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Kode Pos <span>*</span></span>
                                        <input type="text" class="form-control" name="postcode" data-validetta="required" data-vd-message-required="Isi Kode Pos" value="{{ $order->order_address->postcode }}" disabled>	
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Nomor Telepon <span>*</span></span>
                                        <input type="text" class="form-control" name="phone" data-validetta="required" data-vd-message-required="Isi Nomor Telepon" value="{{ $order->order_address->phone }}" disabled>	
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label-text">Fax <span>*</span></span>
                                        <input type="text" class="form-control" name="fax" data-validetta="required" data-vd-message-required="Isi Fax" value="{{ $order->order_address->fax }}" disabled>	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="changed-item">
                        <a class="changed-button"></a>
                        <div class="info">
                            <h4 class="main-title">Metode Pengiriman</h4>
                            <div class="des-changed">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                                        <div class="">
                                            <table class="shopping-cart-content table">
                                                <tbody>
                                                <?php 
                                                    $total = 0; 
                                                    $totalPervendor = 0;
                                                    $totals = 0;
                                                ?>
                                                @foreach ($data['vendor']->distinct()->get() as $v)
                                                <td colspan="4" style="text-align:left;vertical-align:middle;font-weight:bold;font-size:16px;background-color:#F9F7F6;" class="product-name" data-title="Product Name">
                                                    <span style="color:#555">
                                                        {{ $v->vendor_name }} - {{ $v->product_from }}
                                                    </span>
                                                </td>
                                                @foreach ($data['data']->get() as $d)
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
                                                    @if(count($d->order_shipping()->get()) != 0)
                                                    <tr style="border-top:none;border-bottom:none;">
                                                        <td style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="4">
                                                            <span class="label-text" style="text-align:left; font-weight: bold">Biaya Pengiriman</span>
                                                        </td>
                                                    </tr>
                                                    @foreach($d->order_shipping()->get() as $cs)
                                                        <tr style="border-top:none;border-bottom:none;">
                                                            <td class="product-name" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="2">
                                                                {{ $cs->name }}
                                                            </td>
                                                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="2">
                                                                {{ number_format($cs->price, 0) }}
                                                            </td>
                                                        </tr>
                                                        <?php 
                                                            $totals += $cs->price; 
                                                        ?>
                                                    @endforeach
                                                    @endif
                                                    <?php $no++; ?>
                                                    @endif
                                                    <?php 
                                                        $totalPervendor = $total + $totals; 
                                                    ?>
                                                @endforeach
                                                <?php 
                                                    $total = 0; 
                                                    $totals = 0; 
                                                ?>
                                                <tr style="border-bottom:none;">
                                                    <td style="font-size:14px;color:#555;font-weight:bold;text-align:left;vertical-align:middle;" align="left" colspan="2">
                                                        Total
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>
                                                    <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="2">
                                                        Rp. {{ number_format($totalPervendor, 0) }}
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
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
                                        <a href="{{ route('katalog.monitoring.order', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('order')]) }}" class="continue-shopping submit">Kembali</a>
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
                                <div class="total-checkout" style="border:none;">
                                    <span class="text" style="font-size: 16px;">Total </span>
                                    <input type="hidden" id="grandtotal_hide" name="grandtotal_hide" value="{{ $order->order_total }}"/>
                                    <span class="price" id="grandtotal">Rp. <?= number_format($order->order_total, 0) ?></span>
                                </div>
                                <div class="group-button">
                                    @if($order->order_status->name == 'Pending')
                                    <a onclick="showModalCatatanCustomer('{{ $order->order_number }}')" class="button submit" style="cursor: pointer;">
                                        Catatan
                                    </a>
                                    @elseif($order->order_status->name == 'Telah Dikonfirmasi')
                                    <a onclick="showModalCatatanCustomer('{{ $order->order_number }}')" class="button submit" style="cursor: pointer;">
                                        Catatan
                                    </a>
                                    <a style="margin-top:10px;" href="{{ route('katalog.monitoring.finish', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString($order->order_number)]) }}" class="button submit">
                                        Pesanan Selesai
                                    </a>
                                    @elseif($order->order_status->name == 'Selesai')
                                    <a href="{{ route('katalog.monitoring.po.create', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString($order->order_number)]) }}" class="button submit">
                                        Buat PO
                                    </a>
                                    @elseif($order->order_status->name == 'Ditolak')
                                    <a onclick="showModalCatatanCustomer('{{ $order->order_number }}')" class="button submit" style="cursor: pointer;">
                                        Catatan
                                    </a>
                                    <a style="margin-top:10px;" href="{{ route('katalog.monitoring.reorder', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString($order->order_number)]) }}" class="button submit">
                                        Re-order
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="group-button-detail">
                            <a onclick="showPopUpDetailPemesanan();" style="cursor:pointer;" class="button submit">Lihat Detail Order</a>
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src='https://cdn.rawgit.com/hsnaydd/validetta/v1.0.1/dist/validetta.js'></script>
<script>

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

    <?php $jsonProduct = json_encode($data['data']->get()); ?>
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
                                                            <input disabled type="text" autocomplete="off" tabindex="-1" class="form-control" style="width:100%;" name="biaya`+index+`[]" id="biaya`+index+`[]" data-validetta="required" value="` + this.options[this.selectedIndex].text + `">
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
                    <table class="shopping-cart-content table table-scroll small-first-col">
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
                        <?php 
                            $total = 0; 
                        ?>
                        @foreach ($data['vendor']->distinct()->get() as $v)
                        <td colspan="5" style="text-align:left;vertical-align:middle;background-color:#F9F7F6;" class="product-name" data-title="Product Name">
                            <a class="product-name" style="color:#555; font-weight:bold">
                                {{ $v->vendor_name }} - {{ $v->product_from }}
                            </a>
                        </td>
                        @foreach ($data['data']->get() as $d)
                            @if ($d->vendor_id == $v->vendor_id)
                            <?php $no = 0; ?>
                            <tr class="each-item" id="rowqty{{ $d->id }}">
                                <td class="product-thumb">
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
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $d->name }}
                                    </a>
                                </td>
                                <td style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" id="price{{ $d->id }}">
                                    {{ number_format($d->price, 0) }}
                                </td>
                                <td style="text-align:center;vertical-align:middle" class="quantity-item" data-title="Qty">
                                    <div class="quantity">
                                        <div class="group-quantity-button">
                                            <input class="input-text qty text" id='qty{{ $d->id }}' type="text" size="4" title="Qty" value="{{ $d->qty }}" name="qty{{ $d->id }}" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" disabled>
                                        </div>
                                    </div>
                                </td>
                                <?php $subtotal = $d->price * $d->qty; ?>
                                <?php $total += $d->price * $d->qty; ?>
                                <td style="text-align:right;vertical-align:middle" class="total" id="subtotal{{ $d->id }}" data-title="SubTotal">
                                    {{ number_format($subtotal, 0) }}
                                </td>
                            </tr>
                            @if(count($d->order_shipping()->get()) != 0)
                            <tr style="border-top:none;border-bottom:none;">
                                <td style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="5">
                                    <span class="label-text" style="text-align:left; font-weight: bold">Biaya Pengiriman</span>
                                </td>
                            </tr>
                            @foreach($d->order_shipping()->get() as $cs)
                                <tr style="border-top:none;border-bottom:none;">
                                    <td class="product-name" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="4">
                                        <a class="product-name">
                                            {{ $cs->name }}
                                        </a>
                                    </td>
                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                        {{ number_format($cs->price, 0) }}
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            <?php $no++; ?>
                            @endif
                        @endforeach
                        @endforeach
                        </tbody>
                        <tfoot style="display:block;width:100%;">
                            <tr style="margin-top:36px;">
                                <td style="font-size:14px;color:#555;font-weight:bold;text-align:left;vertical-align:middle;" align="left" colspan="3">Total Order</td>
                                <td class="total" style="text-align:right;" colspan="2">Rp. {{ number_format($order->order_total, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>`
		$("#detail-checkout-modal .modal-content .modal-body").html(html);
		$("#detail-checkout-modal").modal('show');
    }

    function checkCatatanCustomer() {
        if($("#catatan-customer-modal .modal-content .modal-body #body-catatan #catatan").val() == '') {
            toastr.error('Isi catatan', 'Informasi!')
        } else {
            $.ajax({
                type:'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url:'{{ route('katalog.monitoring.order.notes.post', [Auth::user()->group->code]) }}',
                data:{
                    order_number: $("#catatan-customer-modal .modal-content .modal-body #order_number").val(),
                    catatan: $("#catatan-customer-modal .modal-content .modal-body #body-catatan #catatan").val(),
                    type: 'Customer',
                },
                success:function(response) {
                    toastr.success("Catatan Terkirim");
                    $("#catatan-customer-modal .modal-content .modal-body #body-catatan").empty()
                    showModalCatatanCustomer(response)
                }
            });
        }
    }

    function showModalCatatanCustomer(order_number) {
        $.ajax({
            type:'GET',
            url:'{{ route('katalog.monitoring.order.notes', [Auth::user()->group->code]) }}',
            data:{
                order_number: order_number
            },
            success:function(response) {
                $("#catatan-customer-modal .modal-content .modal-body #body-catatan").empty();
                var html = ``;
                if(response.order_notes.length == 0) {
                    html += 
                    `<hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea rows="3" class="form-control" id="catatan" name="catatan" type="text"></textarea>
                        </div>
                    </div>`
                } else {
                    html += 
                    `<div class="window">` 
                    response.order_notes.forEach( data=> {
                        if(data.type == 'Customer') {
                            html += 
                            `<div class="chats">
                                <span class="u1 chat">`+data.note+`</span>
                            </div>` 
                        } else {
                            html += 
                            `<div class="chats">
                                <span class="u2 chat">`+data.note+`</span>
                            </div>` 
                        }
                    });
                    html += 
                    `</div>` 
                    html += 
                    `<hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea rows="2" class="form-control" id="catatan" name="catatan" type="text"></textarea>
                        </div>
                    </div>`
                }
                $("#catatan-customer-modal .modal-content .modal-body #order_number").val(order_number);
                $("#catatan-customer-modal .modal-content .modal-body #body-catatan").append(html);
                $("#catatan-customer-modal").modal('show');
            }
        });
    }
</script>
@endpush