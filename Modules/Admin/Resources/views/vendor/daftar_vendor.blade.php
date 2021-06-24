@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb row">
    <li class="col-md-12 breadcrumb-item">
        Daftar Vendor
        <div class="pull-right">
            <form class="form-inline pull-right" action="{{ url()->current() }}">
                <a href="{{ route('admin.vendor',[Auth::user()->group->code, Crypt::encryptString('adminDaftarVendor')]) }}" class="btn btn-danger" style='color:#fff'> Reset</a>&nbsp;
                <input class="form-control" type="text" name="keyword" placeholder="Cari.." value="{{ $keyword }}">&nbsp;
                <button class="btn btn-primary" type="submit">Cari</button>&nbsp;
                <a href="{{ route('admin.vendor.create', [Auth::user()->group->code, Crypt::encryptString('adminVendorCreate')]) }}" class="btn btn-success">
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
                        <table id="tabel-vendor" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Vendor</th>
                                    <th class="text-center" style="vertical-align:middle">Status</th>
                                    <th width="15%" class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendor as $v)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $v->vendor_name }}</td>
                                    <td class="text-center">
                                        @if($v->status == 0) 
                                        <label style="vertical-align:middle;color:white;" class="badge badge-warning text-center">
                                            Tidak Aktif
                                        </label> 
                                        @else
                                        <label style="vertical-align:middle" class="badge badge-success text-center">
                                            Aktif
                                        </label>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" data-placement="left" title="Detail" href="{{ route('admin.vendor.edit', [Auth::user()->group->code, Crypt::encryptString($v->id)]) }}">
                                            <i class="fa fa-eye" style="color: white;"></i>
                                        </a>
                                        {{-- <a class="btn btn-danger" data-placement="right" title="Hapus vendor" type="button" id="hapusVendor" data-id="{{ $v->id }}" data-status="{{ $v->status }}">
                                            <i class="fa fa-trash-o" style="color: white;"></i>
                                        </a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $vendor->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Vendor</h4>
            </div>
            <div class="modal-body">
                <p>
                    Apakah anda yakin?
                </p>
            </div>
            <div class="modal-footer">
                <form id="hapusModalForm" action="" method="POST">
                    @method('POST')
                    @csrf
                    <input type="hidden" name="vendorMasterId" id="vendorMasterId">
                    <button class="btn btn-secondary" style="color:white;" type="button" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-danger" type="submit">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalWarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-warning modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Perhatian</h4>
            </div>
            <div class="modal-body">
                <p>
                    Vendor tersebut masih aktif, harap nonaktifkan terlebih dahulu!
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" style="color:white;" type="button" data-dismiss="modal">Tutup</button>
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
        $('#tabel-vendor .btn').tooltip();
        $("#tabel-vendor").on("click", "#hapusVendor", function () {
            if($(this).attr("data-status") == 1) {
                $('#modalWarning').modal('show');
            } else {
                $('#modalHapus').modal('show');
                $("#modalHapus .modal-dialog .modal-content #vendorMasterId").val($(this).attr("data-id"))
                var formAction = "{{ url('admin/' . Auth::user()->group->code . '/vendor/delete') }}";
                $("#hapusModalForm").attr("action", formAction);
            }
        });
    })
</script>
@endpush