@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Tambah Produk Group</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="first_name">Nama</label>
                    <div class="col-md-10">
                        <input class="form-control" id="first_name" name="first_name" type="text">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="email">Customer Group</label>
                    <div class="col-md-10">
                        <select class="form-control select2" data-placeholder="Customer Group" name="customer_group" id="customer_group">
                            <option></option>
                            @foreach($customer_group as $cg)
                                <option value="{{ $cg->id }}">{{ $cg->customer_group_code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                <input class="switch-input" type="checkbox" id="status_product_group" name="status_product_group" onclick="checkBox()" value="0">
                                <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                            </label>
                            &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">Tidak Aktif</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a class="btn btn-danger" href="{{ route('admin.product_group', [Auth::user()->group->code, Crypt::encryptString('product_group')]) }}">Kembali</a>
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

    $('.select2').select2({
        allowClear: false,
        theme: 'bootstrap',
        width: "100%",
        placeholder: "Pilih Wilayah",
    });

    function checkBox() {
        if (document.getElementById('status_product_group').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
            document.getElementById('status_product_group').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_product_group').value = 0;
        }
    }    
</script>
@endpush