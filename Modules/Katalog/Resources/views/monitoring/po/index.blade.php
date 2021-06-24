@extends('katalog::layouts.app')
@section('content')
<div class="main-content shop-page main-content-detail">
    <div class="container">
        <div class="breadcrumbs">
            <a>List PO</a>
        </div>
        <div class="row content-form">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                <div class="table-responsive">
                    <table id="compare" class="shopping-cart-content table table-striped table-scroll small-first-col">
                        <thead>
                            <tr>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">No. Order</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">No. PO</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Nama Vendor</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Nama Pekerjaan</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Tanggal PO</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="delete-item"></td>
                            </tr>
                        </thead>
                        <tbody class="body-half-screen">
                            @foreach ($po as $key => $o)
                            <tr class="each-item" id="rowqty{{ $o->id }}">
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $o->order_number }}
                                    </a>
                                </td>
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $o->po_number }}
                                    </a>
                                </td>
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $o->vendor_name }}
                                    </a>
                                </td>
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $o->nama_pekerjaan }}
                                    </a>
                                </td>
                                <td style="text-align:center;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ date('d-M-Y', strtotime($o->po_date)) }}
                                    </a>
                                </td>
                                <td style="text-align:center;vertical-align:middle" class="icon">
                                    <a href="{{ route('katalog.monitoring.po.detail_po', [Auth::user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString($o->id)]) }}" style="vertical-align:middle;" class="btn btn-danger">
                                        <i class="fa fa-search" style="color:white"></i>
                                    </a>
                                    <a href="{{ route('katalog.monitoring.po.cetakpdf', [Auth::user()->group()->first()->code, $o->id]) }}" style="color:white;vertical-align:middle;" class="btn btn-danger">
                                        Cetak PDF
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($po) == 0)
                <div class="main-content shop-page page-404">
                    <div>
                        <img src="{{ asset('techone/images/icon/noproduct.png') }}" style="width:250px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                        <h2 class="title">Maaf, tidak ada po </h2>
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
</script>
@endpush