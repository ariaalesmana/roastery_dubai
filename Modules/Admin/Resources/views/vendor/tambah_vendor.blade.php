@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Tambah Vendor</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.vendor.create_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            <div class="card">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="vendor_name">Nama Vendor <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('vendor_name')) is-invalid @endif" id="vendor_name" type="text" name="vendor_name" placeholder="PT Hutama Karya" value="{{ old('vendor_name') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nama Vendor</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="vendor_number">Vendor No <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('vendor_number')) is-invalid @endif" id="vendor_number" type="text" name="vendor_number" placeholder="V00001" value="{{ old('vendor_number') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Vendor</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="email">Email <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('email')) is-invalid @endif" id="email" type="email" name="email" placeholder="hutama@gmail.com" value="{{ old('email') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Email</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="katasandi">Password <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('katasandi')) is-invalid @endif" id="katasandi" type="password" name="katasandi" value="{{ old('katasandi') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kata Sandi</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="company_code">Kode Perusahaan <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('company_code')) is-invalid @endif" id="company_code" type="text" name="company_code" placeholder="X00001" value="{{ old('company_code') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kode Perusahaan</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="inamart_code">Kode Inamart <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('inamart_code')) is-invalid @endif" id="inamart_code" type="text" name="inamart_code" value="{{ $inamart_code }}" readonly>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kode Inamart</em>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="address">Alamat Lengkap <i class="text-danger">(*)</i></label>
                        <div class="col-md-10">
                            <textarea class="form-control @if($errors->has('address')) is-invalid @endif" id="address" name="address" placeholder="Jl HR Rasuna Said, Setiabudi, Kuningan, Jakarta Selatan" type="text">{{ old('address') }}</textarea>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Alamat</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="city">Kota <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('city')) is-invalid @endif" id="city" type="text" name="city" placeholder="Jakarta Selatan" value="{{ old('city') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kota</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="region">Region <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('region')) is-invalid @endif" id="region" type="text" name="region" placeholder="DKI Jakarta" value="{{ old('region') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Region</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="telephone">Telepon <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('telephone')) is-invalid @endif" id="telephone" type="text" name="telephone" placeholder="0218214704" value="{{ old('telephone') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Telepon</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="fax">Fax</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('fax')) is-invalid @endif" id="fax" type="text" name="fax" placeholder="0218214704" value="{{ old('fax') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Fax</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="postcode">Kode Pos <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('postcode')) is-invalid @endif" id="postcode" type="text" name="postcode" placeholder="17423" value="{{ old('postcode') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kode Pos</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="fax">Status <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                    <input class="switch-input @if($errors->has('status_vendor')) is-invalid @endif" type="checkbox" id="status_vendor" name="status_vendor" onclick="checkBox()">
                                    <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                                </label>
                                &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">Tidak Aktif</label>
                            </div>
                            <em id="firstname-error" class="error invalid-feedback">Pilih Status</em>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">
                        Simpan
                    </button>
                    <a class="btn btn-danger" href="{{ route('admin.vendor', [Auth()->user()->group->code, Crypt::encryptString('adminDaftarVendor')]) }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        document.getElementById('status_vendor').value = 0;
    });

    function checkBox() {
        if (document.getElementById('status_vendor').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
        document.getElementById('status_vendor').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_vendor').value = 0;
        }
    }
</script>
@endpush