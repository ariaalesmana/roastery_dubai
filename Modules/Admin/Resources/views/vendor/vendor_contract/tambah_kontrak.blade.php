@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Tambah Kontrak</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.vendor.contract_create_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            <div class="card">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="vendor_name">Nama Vendor <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2 @if($errors->has('vendor_name')) is-invalid @endif" data-placeholder="Pilih Vendor" name="vendor_name" id="vendor_name">
                                <option></option>
                                @foreach($vendor_master as $vm)
                                <option value="{{ $vm->id }}">{{ $vm->vendor_name }}</option>
                                @endforeach
                            </select>
                            <em id="firstname-error" class="error invalid-feedback">Pilih Vendor</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="category">Kategori <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2 @if($errors->has('category')) is-invalid @endif" data-placeholder="Pilih Kategori" name="category" id="category">
                                <option></option>
                                @foreach($category as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            <em id="firstname-error" class="error invalid-feedback">Pilih Kategori</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="contract_name">Nama Kontrak <i class="text-danger">(*)</i></label>
                        <div class="col-md-10">
                            <input class="form-control @if($errors->has('contract_name')) is-invalid @endif" id="contract_name" name="contract_name" type="text" value="{{ old('contract_name') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nama Kontrak</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="contract_no">Nomor Kontrak <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('contract_no')) is-invalid @endif" id="contract_no" name="contract_no" type="text" value="{{ old('contract_no') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nomor Kontrak</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="inamart_code">Harga Kontrak <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control @if($errors->has('contract_price')) is-invalid @endif" id="contract_price" name="contract_price" data-type="currency" type="text" value="{{ old('contract_price') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Harga Kontrak</em>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="contract_start">Tanggal Awal Kontrak <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control js-datepicker @if($errors->has('contract_start')) is-invalid @endif" id="contract_start" autocomplete="off" name="contract_start" type="text" value="{{ old('contract_start') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Tanggal Awal Kontrak</em>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="contract_end">Tanggal Berakhir Kontrak <i class="text-danger">(*)</i></label>
                        <div class="col-md-4">
                            <input class="form-control js-datepicker @if($errors->has('contract_end')) is-invalid @endif" id="contract_end" autocomplete="off" name="contract_end" type="text" value="{{ old('contract_end') }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Tanggal Akhir Kontrak</em>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">
                        Simpan
                    </button>
                    <a class="btn btn-danger" href="{{ route('admin.vendor.contract', [Auth::user()->group->code, Crypt::encryptString('contract')]) }}">Kembali</a>
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
        width: "100%"
    });

    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        }
    });

    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
        
        var input_val = input.val();
        if (input_val === "") { return; }
        var original_len = input_val.length;
        var caret_pos = input.prop("selectionStart");

        if (input_val.indexOf(".") >= 0) {

            var decimal_pos = input_val.indexOf(".");
            var left_side = input_val.substring(0, decimal_pos);
            left_side = formatNumber(left_side);
            input_val = left_side;

        } else {

            input_val = formatNumber(input_val);
            input_val = input_val;
            
            if (blur === "blur") {
                input_val;
            }
        }
        
        input.val(input_val);

        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }

    $('.js-datepicker').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        "autoUpdateInput": false,
        locale: {
            format: 'DD-MMM-Y'
        },
    });

    var myCalendar = $('.js-datepicker');
    var isClick = 0;

    $(window).on('click',function(){
        isClick = 0;
    });

    $(myCalendar).on('apply.daterangepicker',function(ev, picker){
        isClick = 0;
        $(this).val(picker.startDate.format('DD-MMM-Y'));

    });

    $('.js-btn-calendar').on('click',function(e){
        e.stopPropagation();

        if(isClick === 1) isClick = 0;
        else if(isClick === 0) isClick = 1;

        if (isClick === 1) {
            myCalendar.focus();
        }
    });

    $(myCalendar).on('click',function(e){
        e.stopPropagation();
        isClick = 1;
    });

    $('.daterangepicker').on('click',function(e){
        e.stopPropagation();
    });
</script>
@endpush