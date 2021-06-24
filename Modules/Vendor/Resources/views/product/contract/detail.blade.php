@extends('vendor::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Kontrak</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="contract_name">Nama Kontrak</label>
                    <div class="col-md-10">
                        <input class="form-control" id="contract_name" name="contract_name" type="text" value="{{ $vendor_contract_master->contract_name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="contract_no">Nomor Kontrak</label>
                    <div class="col-md-4">
                        <input class="form-control" id="contract_no" name="contract_no" type="text" value="{{ $vendor_contract_master->contract_no }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="contract_price">Harga Kontrak</label>
                    <div class="col-md-4">
                        <input class="form-control" id="contract_price" name="contract_price" type="text" value="{{ number_format($vendor_contract_master->contract_price, 0) }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="company_code">Tanggal Awal Kontrak</label>
                    <div class="col-md-4">
                        <input class="form-control" id="contract_start" name="contract_start" type="text" value="{{ date('d-M-Y', strtotime($vendor_contract_master->contract_start)) }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="inamart_code">Tanggal Akhir Kontrak</label>
                    <div class="col-md-4">
                        <input class="form-control" id="contract_end" name="contract_end" type="text" value="{{ date('d-M-Y', strtotime($vendor_contract_master->contract_end)) }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                <input class="switch-input" type="checkbox" id="status_product_contract" name="status_product_contract" onclick="checkBox()" @if($vendor_contract_master->status == 1) value="1" checked @else value="0" @endif disabled>
                                <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                            </label>
                            &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">@if($vendor_contract_master->status == 1) Aktif @else Tidak Aktif @endif</label>
                        </div>
                    </div>
                </div>

                <h5 class="card-title" style="margin-top:40px;"><b>Detail Produk</b></h5>
                <hr>
                <div class="table-responsive">
                    <table id="tabel-product" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align:middle">No</th>
                                <th class="text-center" style="vertical-align:middle">Nama Produk</th>
                                <th class="text-center" style="vertical-align:middle">Harga</th>
                                <th class="text-center" style="vertical-align:middle">Stok</th>
                            </tr>
                        </thead>
                        <?php 
                            $product_contract = new \App\Product\ProductContract;
                            $product_contract = $product_contract->setConnection(Auth::user()->group->katalog)
                                ->where('vendor_contract_master_id', $vendor_contract_master->id)
                                ->get();
                        ?>
                        <tbody>
                            @foreach ($product_contract as $p)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $p->product->name }}</td>
                                <td class="text-right">{{ number_format($p->product_vendor->price, 0) }}</td>
                                <td class="text-center">{{ number_format($p->product_vendor->stock, 0) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('vendor.product.contract', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('product_contract')]) }}">Kembali</a>
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
    function checkBox() {
        if (document.getElementById('status_product_contract').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
        document.getElementById('status_product_contract').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_product_contract').value = 0;
        }
    }

    $('.select2').select2({
        allowClear: false,
        theme: 'bootstrap',
        width: "100%",
        placeholder: "Pilih Wilayah",
    });
</script>
@endpush