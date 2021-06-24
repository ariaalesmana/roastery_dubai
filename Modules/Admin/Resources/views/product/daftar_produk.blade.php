@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb row">
    <li class="col-md-12 breadcrumb-item">
        Daftar Produk
        <div class="pull-right">
            <form class="form-inline pull-right" action="{{ url()->current() }}">
                <a href="{{ route('admin.product', [Auth::user()->group->code, Crypt::encryptString('product')]) }}" class="btn btn-danger" style='color:#fff'> Reset</a>&nbsp;
                <input class="form-control" type="text" name="keyword" placeholder="Cari.." value="{{ $keyword }}">&nbsp;
                <button class="btn btn-primary" type="submit">Cari</button>
            </form>
        </div>
    </li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="table-responsive">
                        <table id="tabel-product" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Produk</th>
                                    <th class="text-center" style="vertical-align:middle">Vendor</th>
                                    <th class="text-center" style="vertical-align:middle">Status</th>
                                    <th width="15%" class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $key => $p)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $p->product->name }}</td>
                                    <td>{{ $p->vendor->vendor_name }}</td>
                                    <td class="text-center" style="vertical-align:middle">
                                        @if($p->status == 0) 
                                            <label style="vertical-align:middle;color:white;" class="badge badge-warning text-center">Tidak Aktif</label> 
                                        @else
                                            <label style="vertical-align:middle" class="badge badge-success text-center">Aktif</label> 
                                        @endif
                                    </td>
                                    <td style="vertical-align:middle" align="center">
                                        <input type="hidden" name="description{{$key}}" id="description{{$key}}" value="{!! $p->product->short_description !!}"/>
                                        <a class="btn btn-warning" data-placement="left" title="Detail" href="{{ route('admin.product.edit', [Auth::user()->group->code, Crypt::encryptString($p->product_id)]) }}">
                                            <i class="fa fa-eye" style="color:#fff"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $product->links() !!}
                    </div>
                </div>
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

    $(document).ready(function() {
        $('#tabel-product .btn').tooltip();
    })
</script>
@endpush