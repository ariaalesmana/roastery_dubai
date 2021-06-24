@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb row">
    <li class="col-md-12 breadcrumb-item">
        Daftar Kontrak
        <div class="pull-right">
            <form class="form-inline pull-right" action="{{ url()->current() }}">
                <a href="{{ route('admin.vendor.contract', [Auth::user()->group->code, Crypt::encryptString('contract')]) }}" class="btn btn-danger" style='color:#fff'> Reset</a>&nbsp;
                <input class="form-control" type="text" name="keyword" placeholder="Cari.." value="{{ $keyword }}">&nbsp;
                <button class="btn btn-primary" type="submit">Cari</button>&nbsp;
                <a href="{{ route('admin.vendor.contract_create', [Auth::user()->group->code, Crypt::encryptString('contract_create')]) }}" class="btn btn-success">
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
                        <table id="tabel-kontrak" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Vendor</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Kontrak</th>
                                    <th class="text-center" style="vertical-align:middle">Nomor Kontrak</th>
                                    <th class="text-center" style="vertical-align:middle">Status</th>
                                    <th width="15%" class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendor_contract_master as $vcm)
                                <?php
                                    date_default_timezone_set("Asia/Jakarta");
                                    $date = date('Y-m-d H:i:s', strtotime('today'));
                                    $today = \Carbon\Carbon::parse($date);
                                    $statusContract = null;
                                    $btn = null;
                                    if ($today->diffInDays(\Carbon\Carbon::parse(date('Y-m-d H:i:s', strtotime($vcm->contract_end))), false) > 0) {
                                        $statusContract = 'Kontrak Aktif';
                                        $btn = 'success';
                                    } else {
                                        $statusContract = 'Kontrak Expired';
                                        $btn = 'warning';
                                    }
                                ?>
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $vcm->vendor_master->vendor_name }}</td>
                                    <td>{{ $vcm->contract_name }}</td>
                                    <td>{{ $vcm->contract_no }}</td>
                                    <?php 
                                        $category = new \App\Category\Category;
                                        $category = $category->setConnection(Auth::user()->group->katalog)->find($vcm->category);
                                    ?>
                                    <td class="text-center" style="vertical-align:middle">
                                        <label style="vertical-align:middle;color:white;" class="badge badge-{{ $btn }} text-center">{{ $statusContract }}</label>
                                    </td>
                                    <td style="vertical-align:middle" align="center">
                                        <a class="btn btn-warning" data-placement="left" title="Detail" href="{{ route('admin.vendor.contract.edit', [Auth::user()->group->code, Crypt::encryptString($vcm->id)]) }}">
                                            <i class="fa fa-eye" style="color:white"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $vendor_contract_master->links() !!}
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
        $('#tabel-kontrak .btn').tooltip();
    })
</script>
@endpush