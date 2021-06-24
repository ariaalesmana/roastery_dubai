@extends('vendor::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar Kontrak</li>
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
                        <table id="tabel-contract" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Kontrak</th>
                                    <th class="text-center" style="vertical-align:middle">Nomor Kontrak</th>
                                    <th class="text-center" style="vertical-align:middle">Kategori</th>
                                    <th class="text-center" style="vertical-align:middle">Status</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
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
                                    <?php 
                                        $category = new \App\Category\Category;
                                        $category = $category->setConnection(Auth::user()->group->katalog)->find($vcm->category);
                                    ?>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-left">{{ $vcm->contract_name }}</td>
                                    <td class="text-left">{{ $vcm->contract_no }}</td>
                                    <td class="text-left">{{ $category->name }}</td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <label style="vertical-align:middle" class="badge badge-{{ $btn }} text-center">{{ $statusContract }}</label>
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <a class="btn btn-sm btn-primary hover" hover" href="{{ route('vendor.product.contract.detail', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString($vcm->id)]) }}">
                                            <i class="fa fa-eye ihover" style="color:white"><span class='span'>&nbsp;Lihat</span></i>
                                        </a>
                                        <a class="btn btn-sm btn-success hover" href="{{ route('vendor.product.contract.add_product', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString($vcm->id)]) }}">
                                            <i class="fa fa-plus ihover" style="color:#fff"><span class='span'>&nbsp;Tambah Produk</span></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $vendor_contract_master->render() !!}
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

    var table_contract = null;
    table_contract =  $('#tabel-contract').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
</script>
@endpush