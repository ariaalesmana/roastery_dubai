@extends('katalog.layouts.app')
@section('content')
<div class="main-content shop-page main-content-detail">
    <div class="container">
        <div class="breadcrumbs">
            <a>Detail Produk</a>
        </div>
        <div class="row">
            
            @include('katalog.product.detail.descriptions')
            
            @include('katalog.product.detail.related_products')
            
        </div>
        <a class="kembali" href="{{ url()->previous() }}">Kembali</a>
    </div>
</div>
@endsection
@push('scripts')
<script>
    
</script>
@endpush