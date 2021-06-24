@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb row">
    <li class="col-md-12 breadcrumb-item">
        Daftar Customer Group
        <div class="pull-right">
            <form class="form-inline pull-right" action="{{ url()->current() }}">
                <a href="{{ route('admin.customer_group', [Auth()->user()->group->code, Crypt::encryptString('customer_group')]) }}" class="btn btn-danger" style='color:#fff'> Reset</a>&nbsp;
                <input class="form-control" type="text" name="keyword" placeholder="Cari.." value="{{ $keyword }}">&nbsp;
                <button class="btn btn-primary" type="submit">Cari</button>&nbsp;
                <a href="{{ route('admin.customer_group.create', [Auth::user()->group->code, Crypt::encryptString('customer_group')]) }}" class="btn btn-success">
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
                        <table id="tabel-customer_group" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer_group as $cg)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $cg->customer_group_code }}</td>
                                    <td style="vertical-align:middle" align="center">
                                        <a class="btn btn-warning" data-placement="left" title="Detail" href="{{ route('admin.customer_group_show', [Auth::user()->group->code, Crypt::encryptString($cg->id)]) }}">
                                            <i class="fa fa-eye" style="color:white"></i>
                                        </a>
                                        {{-- <a class="btn btn-danger" data-placement="right" title="Hapus">
                                            <i class="fa fa-trash-o" style="color:white"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $customer_group->links() !!}
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
        $('#tabel-customer_group .btn').tooltip();
    })
</script>
@endpush