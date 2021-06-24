@extends('katalog::layouts.app')
@section('content')
<div class="main-content shop-page main-content-detail">
    <div class="container">
        <div class="breadcrumbs">
            <a>List Order</a>
        </div>
        <div class="row content-form">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                <div class="table-responsive">
                    <table id="compare" class="shopping-cart-content table table-striped table-scroll small-first-col">
                        <thead>
                            <tr>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">No. Order</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Dikirim Ke</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Total Order</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Tanggal Order</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Status</td>
                                <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="delete-item"></td>
                            </tr>
                        </thead>
                        <tbody class="body-half-screen">
                            @foreach ($order as $key => $o)
                            <tr class="each-item" id="rowqty{{ $o->id }}">
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $o->order_number }}
                                    </a>
                                </td>
                                <td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        <?php
                                            $customer = new \App\Customer\Customer;
                                            $customer = $customer->setConnection('mysql');
                                        ?>
                                        {{ $customer->find($o->order_by)->first_name }} {{ $customer->find($o->order_by)->last_name }}
                                    </a>
                                </td>
                                <td style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" id="price{{ $o->id }}">
                                    Rp.{{ number_format($o->order_total, 0) }}
                                </td>
                                <td style="text-align:center;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ date('d-M-Y', strtotime($o->created_at)) }}
                                    </a>
                                </td>
                                <td style="text-align:center;vertical-align:middle" class="product-name" data-title="Product Name">
                                    <a class="product-name">
                                        {{ $o->order_status->name }}
                                    </a>
                                </td>
                                <td style="text-align:center;vertical-align:middle" class="icon">
                                    <a href="{{ route('katalog.monitoring.order.detail', [Auth::user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString($o->order_number)]) }}" style="vertical-align:middle;" class="btn btn-danger">
                                        <i class="fa fa-search" style="color:white"></i>
                                    </a>
                                    @if($o->order_status->name == 'Telah Dikonfirmasi')
                                    <a href="{{ route('katalog.monitoring.finish', [Auth::user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString($o->order_number)]) }}" style="color:white;vertical-align:middle;" class="btn btn-danger">
                                        Selesai
                                    </a>
                                    @elseif($o->order_status->name == 'Selesai')
                                    <a href="{{ route('katalog.monitoring.po.create', [Auth::user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString($o->order_number)]) }}" style="color:white;vertical-align:middle;" class="btn btn-danger">
                                        Buat PO
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($order) == 0)
                <div class="main-content shop-page page-404">
                    <div>
                        <img src="{{ asset('techone/images/icon/noproduct.png') }}" style="width:250px;height:140px;margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                        <h2 class="title">Maaf, tidak ada order </h2>
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