@extends('vendor::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar Produk</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-inline pull-right" method="get">
                                <input class="form-control mr-sm-2" type="text" name="q" placeholder="Pencarian..">
                                <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel-product" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Produk</th>
                                    <th class="text-center" style="vertical-align:middle">Harga</th>
                                    <th class="text-center" style="vertical-align:middle">Stok</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $key => $p)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-left">{{ $p->product->name }}</td>
                                    <td class="text-right">{{ number_format($p->price, 0) }}</td>
                                    <td class="text-center">{{ number_format($p->stock, 0) }}</td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <a class="btn btn-sm btn-primary hover" href="{{ route('vendor.product.detail', [Auth::user()->group->code, Crypt::encryptString($p->product_id)]) }}">
                                            <i class="fa fa-eye ihover" style="color:white"><span class='span'>&nbsp;Lihat</span></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning hover" href="{{ route('vendor.product.edit', [Auth::user()->group->code, Crypt::encryptString($p->product_id)]) }}">
                                            <i class="fa fa-edit ihover" style="color:#fff"><span class='span'>&nbsp;Edit</span></i>
                                        </a>
                                        {{-- <a class="btn btn-sm btn-danger hover">
                                            <i class="fa fa-trash-o ihover" style="color:white"><span class='span'>&nbsp;Hapus</span></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $product->render() !!}
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

    var table_product = null;
    table_product =  $('#tabel-product').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
</script>
@endpush