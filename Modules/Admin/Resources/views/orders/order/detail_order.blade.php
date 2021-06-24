@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Pemesanan</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <input id="order_id" name="order_id" type="hidden" value="{{ $order->id }}">
            <div class="card-body">

                <h5 class="card-title" style="margin-top:20px;"><b>Detail Order</b></h5>
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="order_number">No Order</label>
                    <div class="col-md-10">
                        <input class="form-control" id="order_number" name="order_number" type="text" value="{{ $order->order_number }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="name">Nama Pekerjaan</label>
                    <div class="col-md-10">
                        <input class="form-control" id="name" name="name" type="text" value="{{ $order->name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="no_pr">No PR</label>
                    <div class="col-md-10">
                        <input class="form-control" id="no_pr" name="no_pr" type="text" value="{{ $order->no_pr }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="vendor_name">Vendor</label>
                    <div class="col-md-10">
                        <input class="form-control" id="vendor_name" name="vendor_name" type="text" value="{{ $order->vendor_name }} - Katalog {{ $order->vendor_froms->name }}" readonly>
                    </div>
                </div>

                <h5 class="card-title" style="margin-top:40px;"><b>Detail Pemesan</b></h5>
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="first_name">Nama</label>
                    <div class="col-md-10">
                        <input class="form-control" id="first_name" name="first_name" type="text" value="{{ $order->order_address->first_name }} {{ $order->order_address->last_name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="email">Email</label>
                    <div class="col-md-10">
                        <input class="form-control" id="email" name="email" type="email" value="{{ $order->order_address->email }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="company">Perusahaan</label>
                    <div class="col-md-10">
                        <input class="form-control" id="company" name="company" type="text" value="{{ $order->order_address->company }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="address">Alamat</label>
                    <div class="col-md-10">
                        <textarea rows="3" class="form-control" id="address" name="address" type="text" readonly>{{ $order->order_address->address }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="telephone">No Telepon</label>
                    <div class="col-md-4">
                        <input class="form-control" id="telephone" name="telephone" type="text" value="{{ $order->order_address->phone }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="fax">Fax</label>
                    <div class="col-md-4">
                        <input class="form-control" id="fax" name="fax" type="text" value="{{ $order->order_address->fax }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="province">Provinsi</label>
                    <div class="col-md-10">
                        <input class="form-control" id="province" name="province" type="text" value="{{ $order->order_address->province }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="city">Kota</label>
                    <div class="col-md-4">
                        <input class="form-control" id="city" name="city" type="text" value="{{ $order->order_address->city }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="postcode">Kode Pos</label>
                    <div class="col-md-4">
                        <input class="form-control" id="postcode" name="postcode" type="text" value="{{ $order->order_address->postcode }}" readonly>
                    </div>
                </div>
                
                <h5 class="card-title" style="margin-top:40px;"><b>Detail Produk</b></h5>
                <hr>
                <div class="table-responsive">
                    <table id="tabel-cart" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align:middle">No</th>
                                <th class="text-center" style="vertical-align:middle">Produk</th>
                                <th class="text-center" style="vertical-align:middle">Jumlah</th>
                                <th class="text-center" style="vertical-align:middle">Harga Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalproduk = 0; ?>
                            @foreach ($order->order_detail as $od)
                            <tr>
                                <td class="text-center" @if(count($od->order_shipping) != 0) rowspan="{{ count($od->order_shipping) + 2 }}" @else rowspan="1" @endif>{{ ++$i }}</td>
                                <td class="text-left">{{ $od->name }}</td>
                                <td class="text-center">{{ $od->qty }}</td>
                                <td class="text-right">{{ number_format($od->price) }}</td>
                                <?php $totalproduk +=  $od->qty * $od->price ?>
                                @if(count($od->order_shipping) != 0)
                                <tr style="border-top:none;">
                                    <td style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="3">
                                        <span class="label-text" style="text-align:left; font-weight: bold">Biaya Pengiriman</span>
                                    </td>
                                </tr>
                                @foreach($od->order_shipping as $os)
                                <tr style="border-top:none;border-bottom:none;">
                                    <td class="product-name" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="2">
                                        {{ $os->name }}
                                    </td>
                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right">
                                        {{ number_format($os->price, 0) }}
                                    </td>
                                </tr>
                                <?php $totalproduk +=  $os->price ?>
                                @endforeach
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" style="font-weight:bold;vertical-align:middle;" align="left" colspan="3">Total</td>
                                <td class="total text-right" colspan="1">Rp. {{ number_format($totalproduk, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('admin.orders.order', [Auth::user()->group->code, Crypt::encryptString('adminorder')]) }}">Kembali</a>
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

    var table_cart = null;
    table_cart =  $('#tabel-cart').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
</script>
@endpush