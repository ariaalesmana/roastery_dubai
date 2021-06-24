@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Pemesanan</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <input id="cart_id" name="cart_id" type="hidden" value="{{ $cart->id }}">
            <div class="card-body">

                <h5 class="card-title" style="margin-top:20px;"><b>Detail Vendor</b></h5>
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="vendor_name">Nama Vendor</label>
                    <div class="col-md-10">
                        <input class="form-control" id="vendor_name" name="vendor_name" type="text" value="{{ $cart->vendor_name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="vendor_email">Email Vendor</label>
                    <div class="col-md-10">
                        <input class="form-control" id="vendor_email" name="vendor_email" type="text" value="{{ $cart->vendor_email }}" readonly>
                    </div>
                </div>
                
                <h5 class="card-title" style="margin-top:40px;"><b>Detail Produk</b></h5>
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="cart_number">Cart ID</label>
                    <div class="col-md-10">
                        <input class="form-control" id="cart_number" name="cart_number" type="text" value="{{ $cart->cart_number }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="catalog">Katalog</label>
                    <div class="col-md-10">
                        <input class="form-control" id="catalog" name="catalog" type="text" value="{{ $cart->product_froms->name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="product_name">Nama Produk</label>
                    <div class="col-md-10">
                        <input class="form-control" id="product_name" name="product_name" type="text" value="{{ $cart->name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="price">Harga Satuan</label>
                    <div class="col-md-10">
                        <input class="form-control" id="price" name="price" type="text" value="{{ number_format($cart->price) }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="qty">Jumlah</label>
                    <div class="col-md-4">
                        <input class="form-control" id="qty" name="qty" type="text" value="{{ $cart->qty }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="unit">Satuan</label>
                    <div class="col-md-4">
                        <input class="form-control" id="unit" name="unit" type="text" value="{{ $cart->unit }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="sku">SKU</label>
                    <div class="col-md-4">
                        <input class="form-control" id="sku" name="sku" type="text" value="{{ $cart->sku }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="vendor_sku">Vendor SKU</label>
                    <div class="col-md-4">
                        <input class="form-control" id="vendor_sku" name="vendor_sku" type="text" value="{{ $cart->vendor_sku }}" readonly>
                    </div>
                </div>
                
                <h5 class="card-title" style="margin-top:40px;"><b>Biaya Pengiriman</b></h5>
                <hr>
                <div class="form-group row">
                    <fieldset class="form-group col-md-12">
                        <table class="table table-hover col-md-12" id="table_product_shipping" style="border: none;">
                            <tbody style="border: none;">
                                @foreach($cart->cart_shipping as $cs)
                                <tr style="border: none;">
                                    <td width="50%" style="border: none;">
                                        <input type="text" class="form-control" id="name_biaya[]" name="name_biaya[]" value="{{ $cs->name }}" readonly>
                                    </td>
                                    <td width="50%" style="border: none;">
                                        <input type="text" class="form-control" data-type="currency" id="price_biaya[]" name="price_biaya[]" value="{{ number_format($cs->price, 0) }}" readonly>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('admin.orders.cart', [Auth::user()->group->code, Crypt::encryptString('admincart')]) }}">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    @foreach ($errors->all() as $error)
        toastr.error("{{$error}}")
    @endforeach
</script>
@endpush