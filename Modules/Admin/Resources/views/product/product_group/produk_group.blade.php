@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb row">
    <li class="col-md-12 breadcrumb-item">
        Daftar Produk Group
        <div class="pull-right">
            <form class="form-inline pull-right" action="{{ url()->current() }}">
                <a href="{{ route('admin.product_group', [Auth::user()->group->code, Crypt::encryptString('product_group')]) }}" class="btn btn-danger" style='color:#fff'> Reset</a>&nbsp;
                <input class="form-control" type="text" name="keyword" placeholder="Cari.." value="{{ $keyword }}">&nbsp;
                <button class="btn btn-primary" type="submit">Cari</button>&nbsp;
                <a href="{{ route('admin.product_group_create', [Auth::user()->group->code, Crypt::encryptString('customer')]) }}" class="btn btn-success">
                    <span class="span">&nbsp;Tambah</span></i>
                </a>
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
                        <table id="tabel-product_group" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama</th>
                                    <th width="15%" class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product_group_rules as $pgr)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $pgr->rule_name }}</td>
                                    <td style="vertical-align:middle" align="center">
                                        <a class="btn btn-warning" data-placement="left" title="Detail" href="{{ route('admin.product_group_edit', [Auth::user()->group->code, Crypt::encryptString($pgr->id)]) }}">
                                            <i class="fa fa-eye" style="color:#fff"></i>
                                        </a>
                                        {{-- <a class="btn btn-danger" data-placement="right" title="Hapus">
                                            <i class="fa fa-trash-o" style="color:white"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $product_group_rules->links() !!}
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
        $('#tabel-product_group .btn').tooltip();
    })
</script>
@endpush