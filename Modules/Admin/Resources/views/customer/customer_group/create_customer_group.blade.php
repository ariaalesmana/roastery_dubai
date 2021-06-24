@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Customer Group</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.customer_group.create_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="first_name">Nama</label>
                        <div class="col-md-10">
                            <input class="form-control @if($errors->has('customer_group_code')) is-invalid @endif" id="customer_group_code" name="customer_group_code" type="text">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nama Group</em>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">
                        Simpan
                    </button>
                    <a class="btn btn-danger" href="{{ route('admin.customer_group', [Auth::user()->group->code, Crypt::encryptString('customer_group')]) }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>

    $('.select2').select2({
        allowClear: false,
        theme: 'bootstrap',
        width: "100%",
        placeholder: "Pilih Wilayah",
    });
</script>
@endpush