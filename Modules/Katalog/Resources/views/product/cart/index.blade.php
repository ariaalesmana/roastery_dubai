@extends('katalog::layouts.app')
@push('styles')
@endpush
@section('content')
<div class="main-content shop-page main-content-detail">
    <div class="container">
        <div class="breadcrumbs">
            <a>Keranjang</a>
        </div>
        <form method="post" action="{{ route('katalog.cart.update', [Auth::user()->group->code]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="datacart_id[]" id="datacart_id">
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <div class="row content-form">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 content-offset">
                    <div class="table-responsive">
                        <table class="shopping-cart-content table table-striped">
                            <thead style="font-size: 12px;background-color:#F9F7F6;color:#555;">
                                <tr>
                                    <th width="15%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-thumb"></td>
                                    <th width="25%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center product-name">Nama Produk</td>
                                    <th width="20%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center price">Harga Satuan</td>
                                    <th width="25%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center quantity-item">Jumlah</td>	
                                    <th width="20%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="text-center total">SubTotal</td>
                                    <th width="5%" style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="delete-item"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $total = 0; 
                                    $totalPervendor = 0;
                                    $totals = 0; 
                                ?>
                                @foreach ($data['vendor']->distinct()->get() as $v)
                                <td colspan="3" style="text-align:left;vertical-align:middle;font-weight:bold;font-size:16px;background-color:#F9F7F6;" class="product-name" data-title="Product Name">
                                    <span style="color:#555">
                                        {{ $v->vendor_name }} - {{ $v->product_from }}
                                    </span>
                                </td>
                                <td colspan="3" class="delete-item" style="text-align:left;vertical-align:middle;width:auto;background-color:#F9F7F6;">
                                    <button type="button" onclick="checkUpdateCart('{{ $v->vendor_id }}', '{{ $v->product_from }}');" class="pull-right btn btn-primary">Proses Checkout</button>
                                </td>
                                @foreach ($data['data']->get() as $d)
                                @if ($d->vendor_id == $v->vendor_id && $d->product_from == $v->product_from)
                                <?php $no = 0; ?>
                                <input type="hidden" class="input-info" name="cart_number" value="{{ $d->cart_number }}">	
                                <tr class="each-item" id="rowqty{{ $d->id }}" style="border-bottom:none;line-height:30px;">
                                    <td width="15%" class="product-thumb">
                                        @if($d->image == null)
                                        <div style="height:100px;width:100px;">
                                            <img src="{{ asset('techone/images/product_placeholder.jpg') }}" style="width:100px;height:100px;">
                                        </div>
                                        @else
                                        <div style="height:100px;width:100px;">
                                            <img src="{{ $d->image }}" style="width:100px;height:100px;">
                                        </div>
                                        @endif
                                    </td>
                                    <td width="25%" style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                        {{ $d->name }}
                                    </td>
                                    <td width="20%" style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" id="price{{ $d->id }}">
                                        {{ number_format($d->price, 0) }}
                                    </td>
                                    <td width="25%" style="text-align:center;vertical-align:middle" class="quantity-item" data-title="Qty">
                                        <div class="quantity">
                                            <div class="group-quantity-button">
                                                <a class="minus btn btn-default" id="minus{{ $d->id }}" onclick="qty('min','{{ $d->id }}','{{ $d->price }}')">
                                                    <i class="fa fa-minus" aria-hidden="true"></i>
                                                </a>
                                                <input class="input-text qty text" id='qty{{ $d->id }}' type="text" size="4" title="Qty" value="{{ $d->qty }}" name="qty{{ $d->id }}" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                                                <a class="plus btn btn-default" id="plus{{ $d->id }}" onclick="qty('plus','{{ $d->id }}','{{ $d->price }}')">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <?php $subtotal = $d->price * $d->qty; ?>
                                    <?php $total += $d->price * $d->qty; ?>
                                    <?php $totals += $d->price * $d->qty; ?>
                                    <td width="20%" style="text-align:right;vertical-align:middle" class="total" id="subtotal{{ $d->id }}" data-title="SubTotal">
                                        {{ number_format($subtotal, 0) }}
                                    </td>
                                    <td width="5%" style="text-align:center;vertical-align:middle" class="icon" data-title="Remove">
                                        <a style="vertical-align:middle" class="btn btn-sm btn-danger" onclick="showAlert('{{ $d->id }}',' {{ $no }}')">
                                            <i class="fa fa-trash-o" style="color:white"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @endif
                                <?php 
                                    $totalPervendor = $totals; 
                                ?>
                                @endforeach
                                <?php 
                                    $totals = 0; 
                                ?>
                                <tr style="border-bottom:none;">
                                    <td style="font-size:14px;color:#555;font-weight:bold;text-align:left;vertical-align:middle;" align="left" colspan="2">
                                        Total
                                        <br>
                                        <br>
                                        <br>
                                    </td>
                                    <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="3">
                                        Rp. {{ number_format($totalPervendor, 0) }}
                                        <br>
                                        <br>
                                        <br>
                                    </td>
                                    <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($data['data']->get()) == 0)
                    <div class="main-content shop-page page-404">
                        <div>
                            <img src="{{ asset('techone/images/icon/noproduct.png') }}" style="width:250px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                            <h2 class="title">Maaf, tidak ada produk dalam keranjang </h2>
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
                                    <div class="right">
                                        <button type="submit" class="submit continue-shopping">Perbarui Keranjang</button>
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
                                <h4 class="main-title">Pemesanan</h4>
                                <div class="content">
                                    <h5 class="title">Total Keranjang</h5>
                                    <div class="info-checkout" style="display: none;">
                                        <span class="text">Sub Total : </span>
                                        <span class="item" id="granditem"><?= number_format($total, 0) ?></span>
                                    </div>
                                    <div class="total-checkout" style="border:none;">
                                        <span class="text" style="font-size: 16px;">Total </span>
                                        <span class="price" id="grandtotal">Rp. <?= number_format($total, 0) ?></span>
                                    </div>
                                </div>
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
        </form>
        <form id="cout" method="post" action="{{ route('katalog.checkout.index', [Auth::user()->group->code]) }}">
            {{ csrf_field() }}
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var updateCart = false;

    var table_list = null;
    table_list = $('#tabel-cart').DataTable();
    var totals = parseInt(<?= $total ?>);
    var arridcart = <?= json_encode($data['data']->get()) ?>;
    $("#datacart_id").val(JSON.stringify(arridcart));
    var data = <?= $data['data']->get() ?>;

    function qty(stat, id, price) {
        updateCart = true;
        var inputid = "qty" + id;
        var subid = "subtotal" + id;
        var priceid = "price" + id;
        var total = totals;
        var qty = parseInt(document.getElementById(inputid).value);

        if (stat == "plus") {
            total = total - parseInt((document.getElementById(subid).innerText).replace(/\,/g,''));
            document.getElementById(subid).innerText = ((qty + 1) * parseInt((document.getElementById(priceid).innerText).replace(/\,/g,''))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            total = total + parseInt((document.getElementById(subid).innerText).replace(/\,/g,''));
        } else if (stat == "min") {

            if (qty == 1) {
				document.getElementById("minus" + id).disabled = true;
			} else if (qty > 1) {
				document.getElementById("minus" + id).disabled = false;
                total = total - parseInt((document.getElementById(subid).innerText).replace(/\,/g,''));
                document.getElementById(subid).innerText = ((qty - 1) * parseInt((document.getElementById(priceid).innerText).replace(/\,/g,''))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                total = total + parseInt((document.getElementById(subid).innerText).replace(/\,/g,''));
            }
        }

        totals = total;
        document.getElementById("granditem").innerHTML = "" + totals.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        document.getElementById("grandtotal").innerHTML = "Rp. " + totals.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    }

    function showAlert(id, idarr) {
        Swal.fire({
            customClass: 'swal-wide-register',
            html: `	<div style="z-index:9999999;padding:0;margin:0;">
                        <div class="modal-dialog modal-sm modal-primary" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Informasi</h4>
                                </div>
                                <div class="modal-body">
                                    <h5>
                                        Apakah anda yakin?
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <button id="tutupSwal" class="btn btn-sm btn-danger float-right">Tutup</button>
                                    <button id="savesubmit" class="btn btn-sm btn-danger">Ya</button>
                                </div>
                            </div>
                        </div>
                    </div>`,
            onOpen: function() {
                $('#tutupSwal').click(function(){
                    swal.close();
                });
                $('#savesubmit').click(function(){
                    swal.close();
                    removecart(id, idarr)
                });
            },
            showCancelButton: false,
            showConfirmButton: false
        })
    }

    function removecart(id, idarr) {
        $('.modal-loading').modal('show');
        var subhtml  = "subtotal" + id;
        var grandhtml  = "granditem";
        var subtotal = parseInt((document.getElementById(subhtml).innerText).replace(/\,/g,''));
        var grandtotal = parseInt((document.getElementById(grandhtml).innerHTML).replace(/\,/g,''));
        grandtotal = grandtotal - subtotal;
        $.ajax({
            type:'GET',
            url:'{{ route('katalog.cart.delete', [Auth::user()->group->code]) }}',
            data:{
                idcart: id
            },
            success:function(response){
                $('.modal-loading').modal('hide');
                var htmlrowqty = "#rowqty"+id;
                $(htmlrowqty).remove();
                document.getElementById("granditem").innerHTML= grandtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                document.getElementById("grandtotal").innerHTML="Rp." + grandtotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                delete arridcart[idarr];
                $("#datacart_id").val(JSON.stringify(arridcart));
                calculatecart();
                history.go(0);
            }
        });
    }

    function checkUpdateCart(vendor_id, product_from) {
        if (updateCart) {
            var html = `<div style="z-index:9999999;padding:0;margin:0;">
                            <div class="modal-dialog modal-sm modal-primary" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Informasi</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h5>
                                            Anda belum memperbarui keranjang
                                        </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="tutupSwal" class="btn btn-sm btn-danger float-right">Tutup</button>
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
                },
                showCancelButton: false,
                showConfirmButton: false
            })
        } else {
            showAlertProsesCheckout(vendor_id, product_from);
        }
    }

    function showAlertProsesCheckout(vendor_id, product_from) {
        var html = `<div style="z-index:9999999;padding:0;margin:0;">
                        <div class="modal-dialog modal-sm modal-primary" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Informasi</h4>
                                </div>
                                <div class="modal-body">
                                    <h5>
                                        Apakah anda yakin akan memproses checkout?
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <button id="tutupSwal" class="btn btn-sm btn-danger float-right">Tutup</button>
                                    <button id="savesubmit" class="btn btn-sm btn-danger">Ya</button>
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
                $('#savesubmit').click(function(){
                    swal.close();
                    prosesCheckout(vendor_id, product_from)
                });
            },
            showCancelButton: false,
            showConfirmButton: false
        })
    }

    function prosesCheckout(vendor_id, product_from) {
        $('#cout').append(`<input type="hidden" name="vendor_id" value="` + vendor_id + `">
                                <input type="hidden" name="product_from" value="` + product_from + `">
                            `);
        document.getElementById('cout').submit();
    }
</script>
@endpush