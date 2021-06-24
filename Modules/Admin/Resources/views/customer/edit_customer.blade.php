@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Edit Customer</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.customer.edit_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            {{ csrf_field() }}
            <div class="card">
                <input id="customer_id" name="customer_id" type="hidden" value="{{ $customer->id }}">
                <div class="card-body">
                    <h5 class="card-title"><b>Detail Customer</b></h5>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="first_name">Nama Depan</label>
                        <div class="col-md-10">
                            <input class="form-control @if($errors->has('first_name')) is-invalid @endif" id="first_name" name="first_name" type="text" value="{{ $customer->first_name }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nama Depan</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="middle_name">Nama Tengah</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('middle_name')) is-invalid @endif" id="middle_name" name="middle_name" type="text" value="{{ $customer->middle_name }}">
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="last_name">Nama Belakang</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('last_name')) is-invalid @endif" id="last_name" name="last_name" type="text" value="{{ $customer->last_name }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nama Terakhir</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="email">Email</label>
                        <div class="col-md-10">
                            <input class="form-control @if($errors->has('email')) is-invalid @endif" id="email" name="email" type="email" value="{{ $customer->email }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Email</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="katasandi">Password</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('katasandi')) is-invalid @endif" id="katasandi" name="katasandi" type="password" value="{{ $customer->password }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kata Sandi</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="email">Jenis Kelamin</label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2 @if($errors->has('gender')) is-invalid @endif" data-placeholder="Jenis Kelamin" name="gender" id="gender">
                                <option></option>
                                <option value="1" @if($customer->gender == 1) selected @endif>Laki-laki</option>
                                <option value="2" @if($customer->gender == 2) selected @endif>Perempuan</option>
                            </select>
                            <em id="firstname-error" class="error invalid-feedback">Pilih Jenis Kelamin</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="email">Group</label>
                        <div class="col-md-10">
                            <select class="form-control select2 select2-multiple select2-hidden-accessible @if($errors->has('group')) is-invalid @endif" data-placeholder="Group" name="group[]" id="group"multiple="" data-select2-id="select2-2" tabindex="-1" aria-hidden="true">
                                <option></option>
                                @foreach($customer_group as $cg)
                                    <option value="{{ $cg->id }}"
                                        @foreach($customer->customer_grouping()->get() as $cgp)
                                        @if($cgp->customer_group_id == $cg->id)
                                            selected
                                        @endif
                                        @endforeach
                                    >{{ $cg->customer_group_code }}</option>
                                @endforeach
                            </select>
                            <em id="firstname-error" class="error invalid-feedback">Pilih Group</em>
                        </div>
                    </div>
                    
                    <h5 class="card-title" style="margin-top:40px;"><b>Alamat</b></h5>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="street">Alamat</label>
                        <div class="col-md-10">
                            <textarea rows="3" class="form-control @if($errors->has('street')) is-invalid @endif" id="street" name="street" type="text">{{ $customer->customer_address->street }}</textarea>
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Alamat</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="city">Kota</label>
                        <div class="col-md-10">
                            <input class="form-control @if($errors->has('city')) is-invalid @endif" id="city" name="city" type="text" value="{{ $customer->customer_address->city }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kota</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="region">Provinsi</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('region')) is-invalid @endif" id="region" name="region" type="text" value="{{ $customer->customer_address->region }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Provinsi</em>
                        </div>
                        <label class="col-md-2 col-form-label" for="postcode">Kode Pos</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('postcode')) is-invalid @endif" id="postcode" name="postcode" type="text" value="{{ $customer->customer_address->postcode }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Kode Pos</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="telephone">Nomor Telepon</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('telephone')) is-invalid @endif" id="telephone" name="telephone" type="text" value="{{ $customer->customer_address->telephone }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Telepon</em>
                        </div>
                        <label class="col-md-2 col-form-label" for="fax">Fax</label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('fax')) is-invalid @endif" id="fax" name="fax" type="text" value="{{ $customer->customer_address->fax }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Fax</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                    <input class="switch-input" type="checkbox" id="status_customer" name="status_customer" onclick="checkBox()" @if($customer->status == 1) value="1" checked @else value="0" @endif>
                                    <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                                </label>
                                &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">@if($customer->status == 1) Aktif @else Tidak Aktif @endif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">
                        Simpan
                    </button>
                    <a class="btn btn-danger" href="{{ route('admin.customer', [Auth::user()->group->code, Crypt::encryptString('customer')]) }}">Kembali</a>
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

    function checkBox() {
        if (document.getElementById('status_customer').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
            document.getElementById('status_customer').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_customer').value = 0;
        }
    }    
</script>
@endpush