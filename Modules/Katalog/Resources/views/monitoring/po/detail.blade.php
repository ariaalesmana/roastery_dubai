@extends('katalog::layouts.app')
@section('content')
<div class="main-content shop-page checkout-page">
    <div class="container">
        <div class="breadcrumbs">
            <a>Detail PO</a>
        </div>
        <input type="hidden" name="order_number" value="{{ $po->order_number }}">
        <input type="hidden" name="vendor_id" value="{{ $po->vendor_id }}">
        <input type="hidden" name="vendor_from" value="{{ $po->vendor_from }}">
        <div class="row content-form">
            <div class="col-md-5">
                <div class="info">
                    <div class="des-changed show-content">
                        <?php
                            $vendor = new \App\Vendor\VendorMaster;
                            $vendor_master = $vendor->setConnection('mysql');
                            $group = new \App\Group\group;
                            $group = $group->setConnection('mysql');
                            $vendor_master = $vendor_master->where('vendor_katalog_id', $po->vendor_id)->where('group_id', $group->select('id')->where('code',$po->vendor_from)->first()->id)->first();
                        ?>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:10px;">
                                <span class="label-text" style="font-size:16px;margin-bottom:10px;">Vendor</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text" style="font-weight:bold;">{{ $vendor_master->vendor_name }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">{{ $vendor_master->vendor_address_master->street }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">{{ $vendor_master->vendor_address_master->city }}, {{ $vendor_master->vendor_address_master->region }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">Phone : {{ $vendor_master->vendor_address_master->telephone }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">Fax : {{ $vendor_master->vendor_address_master->fax }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">Email : {{ $vendor_master->email }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">NPWP : -</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="info">
                    <div class="des-changed show-content">
                        <?php
                            $customer = new \App\Customer\Customer;
                            $customer = $customer->setConnection('mysql');
                            $customer = $customer->find($po->po_by);
                        ?>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:10px;">
                                <span class="label-text" style="font-size:16px;margin-bottom:10px;">Buyer</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text" style="font-weight:bold;">{{ $customer->company }}</span>
                                
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">@if(isset($customer->customer_address)) {{ $customer->customer_address->street }} @else - @endif</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">@if(isset($customer->customer_address)) {{ $customer->customer_address->city }}, {{ $customer->customer_address->region }} @else - @endif</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">Phone : @if(isset($customer->customer_address)) {{ $customer->customer_address->telephone }} @else - @endif</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">Fax : @if(isset($customer->customer_address)) {{ $customer->customer_address->fax }} @else - @endif</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text">Email : {{ $customer->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="info">
                    <div class="des-changed show-content">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="label-text" style="font-weight:bold;">PO NO </span><br><span class="label-text">{{ $po->po_number }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text" style="font-weight:bold;">Order NO </span><br><span class="label-text">{{ $po->order_number }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text" style="font-weight:bold;">PO Date </span><br><span class="label-text">{{ date('d-M-Y', strtotime($po->po_date)) }}</span>
                            </div>
                            <div class="col-md-12">
                                <span class="label-text" style="font-weight:bold;">NO PR </span><br><span class="label-text">{{ $po->no_pr }}</span>
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
                                            @foreach ($po->po_detail()->get() as $d)
                                            <tr class="each-item" id="rowqty{{ $d->id }}" style="border-bottom:none;line-height:30px;">
                                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                                    {{ $d->uraian_pekerjaan }}
                                                    <input type="hidden" name="uraian_pekerjaan[]" value="{{ $d->uraian_pekerjaan }}">
                                                </td>
                                                <td style="text-align:center;vertical-align:middle" class="quantity-item" data-title="Qty">
                                                    <div class="quantity">
                                                        <div class="group-quantity-button">
                                                            <input style="background-color:transparent;" class="input-text qty text" id='qty{{ $d->id }}' type="text" size="4" value="{{ $d->volume }}" name="vol[]" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" readonly>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="text-align:left;vertical-align:middle" class="product-name">
                                                    {{ $d->satuan }}
                                                    <input type="hidden" name="sat[]" value="{{ $d->satuan }}">
                                                </td>
                                                <td style="text-align:right;vertical-align:middle" class="price" id="price{{ $d->id }}">
                                                    {{ number_format($d->harga_ecatalogue_tanpa_ppn, 0) }}
                                                    <input type="hidden" name="harga_ecatalogue_tanpa_ppn[]" value="{{ $d->harga_ecatalogue_tanpa_ppn }}">
                                                </td>
                                                
                                                <td style="text-align:right;vertical-align:middle" class="total">
                                                    {{ number_format($d->jumlah_tanpa_ppn, 0) }}
                                                    <input type="hidden" name="jumlah_tanpa_ppn[]" value="{{ $d->jumlah_tanpa_ppn }}">
                                                </td>
                                                <td style="text-align:right;vertical-align:middle" class="total">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" data-type="currency" autocomplete="off" tabindex="-1" class="form-control-2 price harga_satuan_final" data-id="{{ $d->id }}" name="harga_satuan_final[]" id="harga_satuan_final{{ $d->id }}" data-validetta="required" data-vd-message-required="Isi Harga Satuan" value="{{ number_format($d->harga_satuan_final_tanpa_ppn, 0) }}" readonly>
                                                </td>
                                                <td style="text-align:right;vertical-align:middle" class="total">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="jumlah_harga_satuan_final[]" id="jumlah_harga_satuan_final{{ $d->id }}" value="{{ number_format($d->harga_total_final_tanpa_ppn, 0) }}" readonly>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @foreach($po->po_detail_biaya_pengiriman()->get() as $os)
                                            <tr style="border-top:none;border-bottom:none;">
                                                <td class="product-name" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="1">
                                                    {{ $os->uraian_pekerjaan }}
                                                    <input type="hidden" name="ongkir_name[]" value="{{ $os->uraian_pekerjaan }}">
                                                </td>
                                                <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                </td>
                                                <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                </td>
                                                <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    {{ number_format($os->harga_ecatalogue_tanpa_ppn, 0) }}
                                                    <input type="hidden" name="ongkir_tanpa_ppn[]" value="{{ number_format($os->harga_ecatalogue_tanpa_ppn, 0) }}">
                                                </td>
                                                <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    {{ number_format($os->jumlah_tanpa_ppn, 0) }}
                                                    <input type="hidden" name="jumlah_ongkir_tanpa_ppn[]" value="{{ $os->jumlah_tanpa_ppn }}">
                                                </td>
                                                <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" data-type="currency" autocomplete="off" tabindex="-1" class="form-control-2 price" data-id="{{ $os->id }}" name="harga_satuan_final_ongkir[]" id="harga_satuan_final_ongkir{{ $os->id }}" data-validetta="required" data-vd-message-required="Isi Harga Satuan" value="{{ number_format($os->harga_satuan_final_tanpa_ppn, 0) }}" readonly>
                                                </td>
                                                <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="jumlah_harga_satuan_final_ongkir[]" id="jumlah_harga_satuan_final_ongkir{{ $os->id }}" value="{{ number_format($os->harga_total_final_tanpa_ppn, 0) }}" readonly>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                    Subtotal
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    {{ number_format($po->po_total_jumlah_tanpa_ppn->subtotal, 0) }}
                                                    <input type="hidden" name="subtotal_jumlah_tanpa_ppn" value="{{ $po->po_total_jumlah_tanpa_ppn->subtotal }}">
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="subtotal_harga_satuan_final" id="subtotal_harga_satuan_final" value="{{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->subtotal, 0) }}" readonly>
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="subtotal_harga_total_final" id="subtotal_harga_total_final" value="{{ number_format($po->po_total_harga_total_final_tanpa_ppn->subtotal, 0) }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                    PPN
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    {{ number_format($po->po_total_jumlah_tanpa_ppn->ppn, 0) }}
                                                    <input type="hidden" name="ppn_jumlah_tanpa_ppn" value="{{ $po->po_total_jumlah_tanpa_ppn->ppn }}">
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="ppn_harga_satuan_final" id="ppn_harga_satuan_final" value="{{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->ppn, 0) }}" readonly>
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="ppn_harga_total_final" id="ppn_harga_total_final" value="{{ number_format($po->po_total_harga_total_final_tanpa_ppn->ppn, 0) }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                    Total
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    {{ number_format($po->po_total_jumlah_tanpa_ppn->total, 0) }}
                                                    <input type="hidden" name="total_jumlah_tanpa_ppn" value="{{ $po->po_total_jumlah_tanpa_ppn->total }}">
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="total_harga_satuan_final" id="total_harga_satuan_final" value="{{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->total, 0) }}" readonly>
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="total_harga_total_final" id="total_harga_total_final" value="{{ number_format($po->po_total_harga_total_final_tanpa_ppn->total, 0) }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="product-name" align="right" colspan="4">
                                                    Harga Pembulatan
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    {{ number_format($po->po_total_jumlah_tanpa_ppn->harga_pembulatan, 0) }}
                                                    <input type="hidden" name="pembulatan_jumlah_tanpa_ppn" value="{{ $po->po_total_jumlah_tanpa_ppn->harga_pembulatan }}">
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="pembulatan_harga_satuan_final" id="pembulatan_harga_satuan_final" value="{{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->harga_pembulatan, 0) }}" readonly>
                                                </td>
                                                <td style="border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right" colspan="1">
                                                    <input style="background-color:transparent;border:none;text-align:right;vertical-align:middle;" type="text" name="pembulatan_harga_total_final" id="pembulatan_harga_total_final" value="{{ number_format($po->po_total_harga_total_final_tanpa_ppn->harga_pembulatan, 0) }}" readonly>
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
                        <a href="{{ route('katalog.monitoring.po.cetakpdf', [Auth::user()->group->code, $po->id]) }}" class="button submit">Cetak PDF</a>
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

    
    
</script>
@endpush