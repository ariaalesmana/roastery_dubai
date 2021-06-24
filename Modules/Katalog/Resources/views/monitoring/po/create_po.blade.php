@extends('katalog::layouts.app')
@section('content')
<div class="main-content shop-page checkout-page">
    <div class="container">
        <div class="breadcrumbs">
            <a>Pembuatan PO</a>
        </div>
        <form id="forms" method="post" action="{{ route('katalog.monitoring.po.post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            {{ csrf_field() }}
            <input type="hidden" name="order_number" value="{{ $order->order_number }}">
            <input type="hidden" name="vendor_id" value="{{ $order->vendor_id }}">
            <input type="hidden" name="vendor_from" value="{{ $order->vendor_from }}">
            <div class="row content-form">
                <div class="checkout-form content-form col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="info">
                        <div class="des-changed show-content">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <span class="label-text">No. Vendor</span>
                                    <input type="text" class="form-control" name="vendor_number" data-validetta="required" data-vd-message-required="Isi Nomor Vendor">
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <span class="label-text">Nama Vendor</span>
                                    <input type="text" class="form-control" name="vendor_name" data-validetta="required" data-vd-message-required="Isi Nama Nama Vendor" value="{{ $order->vendor_name }}" readonly>	
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <span class="label-text">No. PO</span>
                                    <input type="text" autocomplete="off" class="form-control" name="po_number" data-validetta="required" data-vd-message-required="Isi Nomor PO">	
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <span class="label-text">Tanggal PO <span>*</span></span>
                                    <input type="text" autocomplete="off" class="form-control js-datepicker" name="po_date" data-validetta="required" data-vd-message-required="Isi Tanggal PO">	
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <span class="label-text">No PR <span>*</span></span>
                                    <input type="text" autocomplete="off" class="form-control" name="no_pr" value="{{ $order->no_pr }}" readonly>	
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <span class="label-text">Nama Pekerjaan</span>
                                    <input type="text" class="form-control" name="nama_pekerjaan" data-validetta="required" data-vd-message-required="Isi Nama Pekerjaan" value="{{ $order->name }}" readonly>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout-form content-form col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="info">
                        <div class="des-changed">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                                    <div class="">
                                        <table class="shopping-cart-content table table-striped table-bordered" style="margin-top:16px;">
                                            <thead style="font-size: 12px;background-color:#F9F7F6;color:#555;">
                                                <tr>
                                                    <th width="20%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center product-name">Uraian Pekerjaan</td>
                                                    <th width="10%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center price">Vol</td>
                                                    <th width="10%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center quantity-item">Sat</td>	
                                                    <th width="15%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center total">Harga E-Catalogue Tanpa PPN</td>
                                                    <th width="15%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center total">Jumlah Tanpa PPN</td>
                                                    <th width="15%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center total">Harga Satuan (Final Tanpa PPN)</td>
                                                    <th width="15%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center total">Harga Total (Final Tanpa PPN)</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $total = 0; 
                                                $totalPervendor = 0;
                                                $subutotal_jumlah_tanpa_ppn = 0;
                                            ?>
                                            @foreach ($data['data']->get() as $d)
                                                <?php $no = 0; ?>
                                                <?php $subtotal = $d->price * $d->qty; ?>
                                                <?php $total += $d->price * $d->qty; ?>
                                                <?php $harga_satuan_tanpa_ppn = $d->price / 1.1; ?>
                                                <?php $jumlah_tanpa_ppn = $harga_satuan_tanpa_ppn * $d->qty; ?>
                                                <?php $subutotal_jumlah_tanpa_ppn += $jumlah_tanpa_ppn; ?>

                                                <input type="hidden" class="input-info" name="cart_number" value="{{ $d->cart_number }}">
                                                <tr class="each-item" id="rowqty{{ $d->id }}" style="border-bottom:none;line-height:30px;">
                                                    <td width="20%" style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                                        {{ $d->name }}
                                                        <input type="hidden" name="uraian_pekerjaan[]" value="{{ $d->name }}">
                                                    </td>
                                                    <td width="10%" style="text-align:center;vertical-align:middle" class="quantity-item" data-title="Qty">
                                                        <div class="quantity">
                                                            <div class="group-quantity-button">
                                                                <input style="background-color:transparent;" class="input-text qty text" id='qty{{ $d->id }}' type="text" size="4" value="{{ $d->qty }}" name="vol[]" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td width="10%" style="text-align:left;vertical-align:middle" class="product-name">
                                                        {{ $d->unit }}
                                                        <input type="hidden" name="sat[]" value="{{ $d->unit }}">
                                                    </td>
                                                    <td width="15%" style="text-align:right;vertical-align:middle" class="price" id="price{{ $d->id }}">
                                                        {{ number_format($harga_satuan_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="harga_ecatalogue_tanpa_ppn[]" value="{{ $harga_satuan_tanpa_ppn }}">
                                                    </td>
                                                    
                                                    <td width="15%" style="text-align:right;vertical-align:middle" class="total">
                                                        {{ number_format($jumlah_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="jumlah_tanpa_ppn[]" value="{{ $jumlah_tanpa_ppn }}">
                                                    </td>
                                                    <td width="15%" style="text-align:right;vertical-align:middle" class="total">
                                                        <input style="text-align:right;" align="right" type="text" data-type="currency" autocomplete="off" tabindex="-1" class="form-control-2 price harga_satuan_final" data-id="{{ $d->id }}" name="harga_satuan_final[]" id="harga_satuan_final{{ $d->id }}" data-validetta="required" data-vd-message-required="Isi Harga Satuan">
                                                    </td>
                                                    <td width="15%" style="text-align:right;vertical-align:middle" class="total">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="jumlah_harga_satuan_final[]" id="jumlah_harga_satuan_final{{ $d->id }}">
                                                    </td>
                                                </tr>
                                                @foreach($d->order_shipping()->get() as $os)
                                                <?php $ongkir_tanpa_ppn = $os->price / 1.1; ?>
                                                <?php $subutotal_jumlah_tanpa_ppn += $ongkir_tanpa_ppn; ?>
                                                <tr style="border-top:none;border-bottom:none;">
                                                    <td class="product-name" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="1">
                                                        Biaya Pengiriman {{ $os->name }}
                                                        <input type="hidden" name="ongkir_name[]" value="Biaya Pengiriman  {{ $os->name }}">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        {{ number_format($ongkir_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="ongkir_tanpa_ppn[]" value="{{ $ongkir_tanpa_ppn }}">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        {{ number_format($ongkir_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="jumlah_ongkir_tanpa_ppn[]" value="{{ $ongkir_tanpa_ppn }}">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="text-align:right;" align="right" type="text" data-type="currency" autocomplete="off" tabindex="-1" class="form-control-2 price" data-id="{{ $os->id }}" name="harga_satuan_final_ongkir[]" id="harga_satuan_final_ongkir{{ $os->id }}" data-validetta="required" data-vd-message-required="Isi Harga Satuan">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="jumlah_harga_satuan_final_ongkir[]" id="jumlah_harga_satuan_final_ongkir{{ $os->id }}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                                <?php $no++; ?>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                                <?php $ppn_jumlah_tanpa_ppn = ((10/100) * $subutotal_jumlah_tanpa_ppn); ?>
                                                <?php $total_jumlah_tanpa_ppn = $subutotal_jumlah_tanpa_ppn + $ppn_jumlah_tanpa_ppn; ?>
                                                <?php $pembulatan_jumlah_tanpa_ppn = floor(($subutotal_jumlah_tanpa_ppn + $ppn_jumlah_tanpa_ppn)/10000) * 10000; ?>
                                                <tr>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                        Subtotal
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        {{ number_format($subutotal_jumlah_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="subtotal_jumlah_tanpa_ppn" value="{{ $subutotal_jumlah_tanpa_ppn }}">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="subtotal_harga_satuan_final" id="subtotal_harga_satuan_final" readonly>
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="subtotal_harga_total_final" id="subtotal_harga_total_final" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                        PPN
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        {{ number_format($ppn_jumlah_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="ppn_jumlah_tanpa_ppn" value="{{ $ppn_jumlah_tanpa_ppn }}">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="ppn_harga_satuan_final" id="ppn_harga_satuan_final" readonly>
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="ppn_harga_total_final" id="ppn_harga_total_final" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                        Total
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        {{ number_format($total_jumlah_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="total_jumlah_tanpa_ppn" value="{{ $total_jumlah_tanpa_ppn }}">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="total_harga_satuan_final" id="total_harga_satuan_final" readonly>
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="total_harga_total_final" id="total_harga_total_final" readonly>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                        Harga Pembulatan
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        {{ number_format($pembulatan_jumlah_tanpa_ppn, 0) }}
                                                        <input type="hidden" name="pembulatan_jumlah_tanpa_ppn" value="{{ $pembulatan_jumlah_tanpa_ppn }}">
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="pembulatan_harga_satuan_final" id="pembulatan_harga_satuan_final" readonly>
                                                    </td>
                                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                        <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="pembulatan_harga_total_final" id="pembulatan_harga_total_final" readonly>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="border:none;" class="proceed-checkout pull-left">
                    <div style="border:none;" class="content">
                        <div style="border:none;" class="group-button">
                            <a href="{{ route('katalog.monitoring.po.index', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('po')]) }}" class="continue-shopping submit">Kembali</a>
                        </div>
                    </div>
                </div>
                <div style="border:none;" class="proceed-checkout pull-right">
                    <div style="border:none;" class="content">
                        <div style="border:none;" class="group-button">
                            <button class="button submit">Submit</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

    $('.js-datepicker').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": false,
        locale: {
            format: 'YYYY-MM-DD'
        },
    });

    var myCalendar = $('.js-datepicker');
    var isClick = 0;

    $(window).on('click',function(){
        isClick = 0;
    });

    $(myCalendar).on('apply.daterangepicker',function(ev, picker){
        isClick = 0;
        $(this).val(picker.startDate.format('YYYY-MM-DD'));

    });

    $('.js-btn-calendar').on('click',function(e){
        e.stopPropagation();

        if(isClick === 1) isClick = 0;
        else if(isClick === 0) isClick = 1;

        if (isClick === 1) {
            myCalendar.focus();
        }
    });

    $(myCalendar).on('click',function(e){
        e.stopPropagation();
        isClick = 1;
    });

    $('.daterangepicker').on('click',function(e){
        e.stopPropagation();
    });

    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        }
    });

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
        
        var input_val = input.val();
        if (input_val === "") { return; }
        var original_len = input_val.length;
        var caret_pos = input.prop("selectionStart");

        if (input_val.indexOf(".") >= 0) {

            var decimal_pos = input_val.indexOf(".");
            var left_side = input_val.substring(0, decimal_pos);
            left_side = formatNumber(left_side);
            input_val = left_side;

        } else {

            input_val = formatNumber(input_val);
            input_val = input_val;
            
            if (blur === "blur") {
                input_val;
            }
        }
        
        input.val(input_val);

        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

    var arrayInput_harga_satuan_final = [];
    var arrayId_harga_satuan_final = [];
    var arrayCek_harga_satuan_final = [];
    var subtotal_harga_satuan_final = 0;

    var arrayInput_jumlah_harga_satuan_final = [];
    var arrayId_jumlah_harga_satuan_final = [];
    var arrayCek_jumlah_harga_satuan_final = [];
    var subtotal_harga_total_final = 0;

    var arrayInput_harga_satuan_final_ongkir = [];
    var arrayId_harga_satuan_final_ongkir = [];
    var arrayCek_harga_satuan_final_ongkir = [];
    var subtotal_harga_satuan_final_ongkir = 0;

    var arrayInput_jumlah_harga_satuan_final_ongkir = [];
    var arrayId_jumlah_harga_satuan_final_ongkir = [];
    var arrayCek_jumlah_harga_satuan_final_ongkir = [];
    var subtotal_harga_total_final_ongkir = 0;

    var cekInput_harga_satuan_final = document.getElementsByName('harga_satuan_final[]');
    for(var i = 0; i < cekInput_harga_satuan_final.length; i++) {
        arrayInput_harga_satuan_final[i] = '#'+cekInput_harga_satuan_final[i].id;
        arrayId_harga_satuan_final[i] = cekInput_harga_satuan_final[i].getAttribute('data-id');
    }
    $.each(arrayId_harga_satuan_final, function(index, data){
        $('#harga_satuan_final'+data).on('paste input',function() {
            var qty = (document.getElementById('qty'+$(this).attr('data-id')).value).split(',').join("");
            var jumlah_harga_satuan_final = parseInt(($(this).val()).split(',').join("")) * parseInt(qty);
            document.getElementById('jumlah_harga_satuan_final'+$(this).attr('data-id')).value = parseInt(jumlah_harga_satuan_final).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            
            if($(this).val() == '') {
                document.getElementById('jumlah_harga_satuan_final'+$(this).attr('data-id')).value = '';
            }
            var harga_satuan_final = document.getElementsByName('harga_satuan_final[]');
            for(var i = 0; i < harga_satuan_final.length; i++) {
                if(isNaN(parseInt(harga_satuan_final[i].value.split(',').join("")))) {
                    arrayCek_harga_satuan_final[i] = 0;
                } else {
                    arrayCek_harga_satuan_final[i] = parseInt(harga_satuan_final[i].value.split(',').join(""));
                }
            }
            subtotal_harga_satuan_final = 0;
            for(var i = 0; i < arrayCek_harga_satuan_final.length; i++) {
                subtotal_harga_satuan_final += arrayCek_harga_satuan_final[i];
            }

            if(!arrayCek_harga_satuan_final_ongkir.every(checkZero)) {
                var harga_satuan_final_ongkir = document.getElementsByName('harga_satuan_final_ongkir[]');
                for(var i = 0; i < harga_satuan_final_ongkir.length; i++) {
                    if(isNaN(parseInt(harga_satuan_final_ongkir[i].value.split(',').join("")))) {
                        arrayCek_harga_satuan_final_ongkir[i] = 0;
                    } else {
                        arrayCek_harga_satuan_final_ongkir[i] = parseInt(harga_satuan_final_ongkir[i].value.split(',').join(""));
                    }
                }
                subtotal_harga_satuan_final_ongkir = 0;
                for(var i = 0; i < arrayCek_harga_satuan_final_ongkir.length; i++) {
                    subtotal_harga_satuan_final_ongkir += arrayCek_harga_satuan_final_ongkir[i];
                }
            }

            var jumlah_harga_satuan_final = document.getElementsByName('jumlah_harga_satuan_final[]');
            for(var i = 0; i < jumlah_harga_satuan_final.length; i++) {
                if(isNaN(parseInt(jumlah_harga_satuan_final[i].value.split(',').join("")))) {
                    arrayCek_jumlah_harga_satuan_final[i] = 0;
                } else {
                    arrayCek_jumlah_harga_satuan_final[i] = parseInt(jumlah_harga_satuan_final[i].value.split(',').join(""));
                }
            }
            subtotal_harga_total_final = 0;
            for(var i = 0; i < arrayCek_jumlah_harga_satuan_final.length; i++) {
                subtotal_harga_total_final += arrayCek_jumlah_harga_satuan_final[i];
            }
            
            if(!arrayCek_jumlah_harga_satuan_final_ongkir.every(checkZero)) {
                var jumlah_harga_satuan_final_ongkir = document.getElementsByName('jumlah_harga_satuan_final_ongkir[]');
                for(var i = 0; i < jumlah_harga_satuan_final_ongkir.length; i++) {
                    if(isNaN(parseInt(jumlah_harga_satuan_final_ongkir[i].value.split(',').join("")))) {
                        arrayCek_jumlah_harga_satuan_final_ongkir[i] = 0;
                    } else {
                        arrayCek_jumlah_harga_satuan_final_ongkir[i] = parseInt(jumlah_harga_satuan_final_ongkir[i].value.split(',').join(""));
                    }
                }
                subtotal_harga_total_final_ongkir = 0;
                for(var i = 0; i < arrayCek_jumlah_harga_satuan_final_ongkir.length; i++) {
                    subtotal_harga_total_final_ongkir += arrayCek_jumlah_harga_satuan_final_ongkir[i];
                }
            }

            if(arrayCek_harga_satuan_final.every(checkZero) && arrayCek_harga_satuan_final_ongkir.every(checkZero)) {
                document.getElementById('subtotal_harga_satuan_final').value = '';
                document.getElementById('ppn_harga_satuan_final').value = '';
                document.getElementById('total_harga_satuan_final').value = '';
                document.getElementById('pembulatan_harga_satuan_final').value = '';
                
            } else {
                var subtotal_all = (parseInt(subtotal_harga_satuan_final_ongkir) + parseInt(subtotal_harga_satuan_final));
                var ppn_all = ((10/100) * parseInt(subtotal_all));
                var total_all = parseInt(subtotal_all) + parseInt(ppn_all);
                var pembulatan_all = Math.floor((parseInt(subtotal_all) + parseInt(ppn_all))/10000) * 10000;

                document.getElementById('subtotal_harga_satuan_final').value = parseInt(subtotal_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('ppn_harga_satuan_final').value = parseInt(ppn_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('total_harga_satuan_final').value = parseInt(total_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('pembulatan_harga_satuan_final').value = parseInt(pembulatan_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                
            }

            if(arrayCek_jumlah_harga_satuan_final.every(checkZero) && arrayCek_jumlah_harga_satuan_final_ongkir.every(checkZero)) {
                document.getElementById('subtotal_harga_total_final').value = '';
                document.getElementById('ppn_harga_total_final').value = '';
                document.getElementById('total_harga_total_final').value = '';
                document.getElementById('pembulatan_harga_total_final').value = '';
                
            } else {
                var subtotal_harga_total_final_all = (parseInt(subtotal_harga_total_final_ongkir) + parseInt(subtotal_harga_total_final));
                var ppn_harga_total_final_all = ((10/100) * parseInt(subtotal_harga_total_final_all));
                var total_harga_total_final_all = parseInt(subtotal_harga_total_final_all) + parseInt(ppn_harga_total_final_all);
                var pembulatan_harga_total_final_all = Math.floor((parseInt(subtotal_harga_total_final_all) + parseInt(ppn_harga_total_final_all))/10000) * 10000;

                document.getElementById('subtotal_harga_total_final').value = parseInt(subtotal_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('ppn_harga_total_final').value = parseInt(ppn_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('total_harga_total_final').value = parseInt(total_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('pembulatan_harga_total_final').value = parseInt(pembulatan_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            }
        });
    });

    var cekInput_harga_satuan_final_ongkir = document.getElementsByName('harga_satuan_final_ongkir[]');
    for(var i = 0; i < cekInput_harga_satuan_final_ongkir.length; i++) {
        arrayInput_harga_satuan_final_ongkir[i] = '#'+cekInput_harga_satuan_final_ongkir[i].id;
        arrayId_harga_satuan_final_ongkir[i] = cekInput_harga_satuan_final_ongkir[i].getAttribute('data-id');
    }
    $.each(arrayId_harga_satuan_final_ongkir, function(index, data){
        $('#harga_satuan_final_ongkir'+data).on('paste input',function() {
            var qty = 1;
            var jumlah_harga_satuan_final_ongkir = parseInt(($(this).val()).split(',').join("")) * parseInt(qty);
            document.getElementById('jumlah_harga_satuan_final_ongkir'+$(this).attr('data-id')).value = parseInt(jumlah_harga_satuan_final_ongkir).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');

            if($(this).val() == '') {
                document.getElementById('jumlah_harga_satuan_final_ongkir'+$(this).attr('data-id')).value = '';
            }
            var harga_satuan_final_ongkir = document.getElementsByName('harga_satuan_final_ongkir[]');
            for(var i = 0; i < harga_satuan_final_ongkir.length; i++) {
                if(isNaN(parseInt(harga_satuan_final_ongkir[i].value.split(',').join("")))) {
                    arrayCek_harga_satuan_final_ongkir[i] = 0;
                } else {
                    arrayCek_harga_satuan_final_ongkir[i] = parseInt(harga_satuan_final_ongkir[i].value.split(',').join(""));
                }
            }
            subtotal_harga_satuan_final_ongkir = 0;
            for(var i = 0; i < arrayCek_harga_satuan_final_ongkir.length; i++) {
                subtotal_harga_satuan_final_ongkir += arrayCek_harga_satuan_final_ongkir[i];
            }

            if(!arrayCek_harga_satuan_final.every(checkZero)) {
                var harga_satuan_final = document.getElementsByName('harga_satuan_final[]');
                for(var i = 0; i < harga_satuan_final.length; i++) {
                    if(isNaN(parseInt(harga_satuan_final[i].value.split(',').join("")))) {
                        arrayCek_harga_satuan_final[i] = 0;
                    } else {
                        arrayCek_harga_satuan_final[i] = parseInt(harga_satuan_final[i].value.split(',').join(""));
                    }
                }
                subtotal_harga_satuan_final = 0;
                for(var i = 0; i < arrayCek_harga_satuan_final.length; i++) {
                    subtotal_harga_satuan_final += arrayCek_harga_satuan_final[i];
                }
            }

            var jumlah_harga_satuan_final_ongkir = document.getElementsByName('jumlah_harga_satuan_final_ongkir[]');
            for(var i = 0; i < jumlah_harga_satuan_final_ongkir.length; i++) {
                if(isNaN(parseInt(jumlah_harga_satuan_final_ongkir[i].value.split(',').join("")))) {
                    arrayCek_jumlah_harga_satuan_final_ongkir[i] = 0;
                } else {
                    arrayCek_jumlah_harga_satuan_final_ongkir[i] = parseInt(jumlah_harga_satuan_final_ongkir[i].value.split(',').join(""));
                }
            }
            subtotal_harga_total_final_ongkir = 0;
            for(var i = 0; i < arrayCek_jumlah_harga_satuan_final_ongkir.length; i++) {
                subtotal_harga_total_final_ongkir += arrayCek_jumlah_harga_satuan_final_ongkir[i];
            }

            if(!arrayCek_jumlah_harga_satuan_final.every(checkZero)) {
                var jumlah_harga_satuan_final = document.getElementsByName('jumlah_harga_satuan_final[]');
                for(var i = 0; i < jumlah_harga_satuan_final.length; i++) {
                    if(isNaN(parseInt(jumlah_harga_satuan_final[i].value.split(',').join("")))) {
                        arrayCek_jumlah_harga_satuan_final[i] = 0;
                    } else {
                        arrayCek_jumlah_harga_satuan_final[i] = parseInt(jumlah_harga_satuan_final[i].value.split(',').join(""));
                    }
                }
                subtotal_harga_total_final = 0;
                for(var i = 0; i < arrayCek_jumlah_harga_satuan_final.length; i++) {
                    subtotal_harga_total_final += arrayCek_jumlah_harga_satuan_final[i];
                }
            }

            if(arrayCek_harga_satuan_final.every(checkZero) && arrayCek_harga_satuan_final_ongkir.every(checkZero)) {
                document.getElementById('subtotal_harga_satuan_final').value = '';
                document.getElementById('ppn_harga_satuan_final').value = '';
                document.getElementById('total_harga_satuan_final').value = '';
                document.getElementById('pembulatan_harga_satuan_final').value = '';
                
            } else {
                var subtotal_all = (parseInt(subtotal_harga_satuan_final_ongkir) + parseInt(subtotal_harga_satuan_final));
                var ppn_all = ((10/100) * parseInt(subtotal_all));
                var total_all = parseInt(subtotal_all) + parseInt(ppn_all);
                var pembulatan_all = Math.floor((parseInt(subtotal_all) + parseInt(ppn_all))/10000) * 10000;

                document.getElementById('subtotal_harga_satuan_final').value = parseInt(subtotal_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('ppn_harga_satuan_final').value = parseInt(ppn_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('total_harga_satuan_final').value = parseInt(total_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('pembulatan_harga_satuan_final').value = parseInt(pembulatan_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            }

            if(arrayCek_jumlah_harga_satuan_final.every(checkZero) && arrayCek_jumlah_harga_satuan_final_ongkir.every(checkZero)) {
                document.getElementById('subtotal_harga_total_final').value = '';
                document.getElementById('ppn_harga_total_final').value = '';
                document.getElementById('total_harga_total_final').value = '';
                document.getElementById('pembulatan_harga_total_final').value = '';
                
            } else {
                var subtotal_harga_total_final_all = (parseInt(subtotal_harga_total_final_ongkir) + parseInt(subtotal_harga_total_final));
                var ppn_harga_total_final_all = ((10/100) * parseInt(subtotal_harga_total_final_all));
                var total_harga_total_final_all = parseInt(subtotal_harga_total_final_all) + parseInt(ppn_harga_total_final_all);
                var pembulatan_harga_total_final_all = Math.floor((parseInt(subtotal_harga_total_final_all) + parseInt(ppn_harga_total_final_all))/10000) * 10000;

                document.getElementById('subtotal_harga_total_final').value = parseInt(subtotal_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('ppn_harga_total_final').value = parseInt(ppn_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('total_harga_total_final').value = parseInt(total_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                document.getElementById('pembulatan_harga_total_final').value = parseInt(pembulatan_harga_total_final_all).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            }
        });
    });

    function checkZero(arr) {
        return arr == 0;
    }
    
</script>
@endpush