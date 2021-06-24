@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Edit Vendor</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.vendor.edit_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            <div class="card">
                {{ csrf_field() }}
                <input id="vendor_master_id" name="vendor_master_id" type="hidden" value="{{ $vendor_master->id }}">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="vendor_name">Nama Vendor <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('vendor_name')) is-invalid @endif" id="vendor_name" name="vendor_name" type="text" @if (old('vendor_name') != null) value="{{ old('vendor_name') }}" @else value="{{ $vendor_master->vendor_name }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nama Vendor</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="vendor_number">Vendor No <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('vendor_number')) is-invalid @endif" id="vendor_number" name="vendor_number" type="text" @if (old('vendor_number') != null) value="{{ old('vendor_number') }}" @else value="{{ $vendor_master->vendor_number }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Vendor</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="email">Email <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" type="email" @if (old('email') != null) value="{{ old('email') }}" @else value="{{ $vendor_master->email }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Email</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="katasandi">Password <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('katasandi')) is-invalid @endif" id="katasandi" name="katasandi" type="password" @if (old('katasandi') != null) value="{{ old('password') }}" @else value="{{ $vendor_master->password }}" @endif readonly>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kata Sandi</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="company_code">Kode Perusahaan <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('company_code')) is-invalid @endif" id="company_code" name="company_code" type="text" @if (old('company_code') != null) value="{{ old('company_code') }}" @else @if(isset($vendor_master->vendor_code_master)) value="{{ $vendor_master->vendor_code_master->company_code }}" @endif @endif readonly>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kode Perusahaan</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="inamart_code">Kode Inamart <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('inamart_code')) is-invalid @endif" id="inamart_code" name="inamart_code" type="text" @if (old('inamart_code') != null) value="{{ old('inamart_code') }}" @else @if(isset($vendor_master->vendor_code_master)) value="{{ $vendor_master->vendor_code_master->inamart_code }}" @endif @endif readonly>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kode Inamart</em>
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="address">Alamat Lengkap <i class="text-danger">(*)</i></label>
                        <div class="col-md-10">
                            <textarea class="form-control @if($errors->has('address')) is-invalid @endif" id="address" name="address" type="text">@if (old('address') != null) {{ old('address') }} @else {{ $vendor_master->vendor_address_master->street }} @endif</textarea>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Alamat</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="city">Kota <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('city')) is-invalid @endif" id="city" name="city" type="text" @if (old('city') != null) value="{{ old('city') }}" @else value="{{ $vendor_master->vendor_address_master->city }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kota</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="region">Region <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('region')) is-invalid @endif" id="region" name="region" type="text" @if (old('region') != null) value="{{ old('region') }}" @else value="{{ $vendor_master->vendor_address_master->region }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Region</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="telephone">Telepon <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('telephone')) is-invalid @endif" id="telephone" name="telephone" type="text" @if (old('telephone') != null) value="{{ old('telephone') }}" @else value="{{ $vendor_master->vendor_address_master->telephone }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Telepon</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="fax">Fax <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('fax')) is-invalid @endif" id="fax" name="fax" type="text" @if (old('fax') != null) value="{{ old('fax') }}" @else value="{{ $vendor_master->vendor_address_master->fax }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Fax</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="postcode">Kode Pos <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('postcode')) is-invalid @endif" id="postcode" name="postcode" type="text" @if (old('postcode') != null) value="{{ old('postcode') }}" @else value="{{ $vendor_master->vendor_address_master->postcode }}" @endif>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kode Pos</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="fax">Status <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                    <input class="switch-input" type="checkbox" id="status_vendor" name="status_vendor" onclick="checkBox()" @if($vendor_master->status == 1) value="1" checked @else value="0" @endif>
                                    <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                                </label>
                                &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">@if($vendor_master->status == 1) Aktif @else Tidak Aktif @endif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit" style="margin-left:10px;">
                        Simpan
                    </button>
                    <a class="btn btn-success float-right" data-toggle="modal" data-target="#password-modal" style="color:white;">
                        Update Password
                    </a>
                    <a class="btn btn-danger" href="{{ route('admin.vendor', [Auth::user()->group->code, Crypt::encryptString('adminDaftarVendor')]) }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="password-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-md">
        <div class="modal-content">
            <form id="form-ubah-password" method="post" action="{{ route('admin.vendor.edit.ubah_password', [Auth::user()->group->code]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Password</h4>
                </div>
                <div class="modal-body">
                    <input id="vendor_master_id" name="vendor_master_id" type="hidden" value="{{ $vendor_master->id }}">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="telephone">Password <i class="text-danger">(*)</i></label>
                        <div class="col-md-7">
                            <input class="form-control" id="modal_password" name="modal_password" type="password">
                        </div>
                        <div class="col-md-1">
                            <a class="btn btn-warning pull-left" style="margin-top:5px;" id="showPassword">
                                <i class="fa fa-eye" style="color: white;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="telephone">Konfirmasi Password <i class="text-danger">(*)</i></label>
                        <div class="col-md-7">
                            <input class="form-control" id="modal_konfirmasi_password" name="modal_konfirmasi_password" type="password">
                        </div>
                        <div class="col-md-1">
                            <a class="btn btn-warning pull-left" style="margin-top:5px;" id="showKonfirmasiPassword">
                                <i class="fa fa-eye" style="color: white;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary pull-left" type="button" data-dismiss="modal" style="color: white;">Tutup</button>
                    <button class="btn btn-primary pull-right" type="button" onclick="simpanUbahPassword()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>

    function checkBox() {
        if (document.getElementById('status_vendor').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
        document.getElementById('status_vendor').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_vendor').value = 0;
        }
    }

    function simpanUbahPassword() {
        if($('#modal_password').val() == '') {
            toastr.error('Password wajib diisi', 'Informasi!')
        } else if($('#modal_konfirmasi_password').val() == '') {
            toastr.error('Konfirmasi password wajib diisi', 'Informasi!')
        } else if($('#modal_konfirmasi_password').val() != $('#modal_password').val()) {
            toastr.error('Konfirmasi password salah', 'Informasi!')
        } else {
            $('#form-ubah-password').submit();
        }
    }

    $('#password-modal').on('shown.bs.modal', function (e) {
        var click = false;
        $('#showPassword').on('click', function() {
            if(!click) {
                $('#modal_password').attr('type',"text"); 
                click = true;
            } else {
                $('#modal_password').attr('type',"password"); 
                click = false;
            }
        });
        $('#showKonfirmasiPassword').on('click', function() {
            if(!click) {
                $('#modal_konfirmasi_password').attr('type',"text"); 
                click = true;
            } else {
                $('#modal_konfirmasi_password').attr('type',"password"); 
                click = false;
            }
        });
    })
</script>
@endpush