@extends('vendor::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Produk</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.product.edit_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            <div class="card">
                {{ csrf_field() }}
                <input id="product_id" name="product_id" type="hidden" value="{{ $product->product_id }}">
                <input id="id" name="id" type="hidden" value="{{ $product->id }}">
                <div class="card-body">
                    <h5 class="card-title"><b>Detail Kontrak</b></h5>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="contract_name">Nama Kontrak</label>
                        <div class="col-md-10">
                            <input class="form-control" id="contract_name" name="contract_name" type="text" value="{{ $product->product_contract->contract_name }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="contract_no">Nomor Kontrak</label>
                        <div class="col-md-4">
                            <input class="form-control" id="contract_no" name="contract_no" type="text" value="{{ $product->product_contract->contract_no }}" readonly>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="contract_price">Harga Kontrak</label>
                        <div class="col-md-4">
                            <input class="form-control" id="contract_price" name="contract_price" type="text" value="{{ number_format($product->product_contract->contract_price, 0) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="company_code">Tanggal Awal Kontrak</label>
                        <div class="col-md-4">
                            <input class="form-control" id="contract_start" name="contract_start" type="text" value="{{ date('d-M-Y', strtotime($product->product_contract->contract_start)) }}" readonly>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="inamart_code">Tanggal Akhir Kontrak</label>
                        <div class="col-md-4">
                            <input class="form-control" id="contract_end" name="contract_end" type="text" value="{{ date('d-M-Y', strtotime($product->product_contract->contract_end)) }}" readonly>
                        </div>
                    </div>

                    
                    <h5 class="card-title" style="margin-top:40px;"><b>Detail Produk</b></h5>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">Nama Produk <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <textarea rows="3" class="form-control" id="name" name="name" type="text" readonly>{{ $product->product->name }}</textarea>
                        </div>
                        @if($product->product->qrcode)
                            <label class="col-md-2 col-form-label text-right" for="name">QRCode</label>
                            <div class="col-md-4">
                                <img src="{{asset(str_replace('public/files', 'storage/files', $product->product->qrcode))}}" class="form-control" style="width:100px; height:100px; position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;">
                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="price">Harga <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="price" name="price" type="text" data-type="currency" value="{{ number_format($product->price, 0) }}" readonly>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="unit">Satuan <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="unit" name="unit" type="text" value="{{ $product->product->unit }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="sku">SKU <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="sku" name="sku" type="text" value="{{ $product->product->sku }}" readonly>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="vendor_sku">Vendor SKU <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="vendor_sku" name="vendor_sku" type="text" value="{{ $product->product->vendor_sku }}" readonly>
                        </div>
                    </div>
                    <?php 
                        $cat = new \App\Category\Category;
                        $category = $cat->where('level', 2)->whereIn('id', $category_product)->get();
                        $subcategory = $cat->where('level', 3)->whereIn('id', $category_product)->get();
                        $subsubcategory = $cat->where('level', 4)->whereIn('id', $category_product)->get();
                    ?>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="category">Kategori <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2" data-placeholder="Kategori" name="category" id="category" disabled>
                                @if(!$category->isEmpty()) <option selected="" disabled value="{{ $category[0]->id }}">{{ $category[0]->name }}</option> @endif
                            </select>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="subcategory">Sub Kategori <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2" data-placeholder="Sub Kategori" name="subcategory" id="subcategory" disabled>
                                @if(!$subcategory->isEmpty()) <option selected="" disabled value="{{ $subcategory[0]->id }}">{{ $subcategory[0]->name }}</option> @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="subsubcategory">Sub Sub Kategori <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2" data-placeholder="Sub Sub Kategori" name="subsubcategory" id="subsubcategory" disabled>
                                @if(!$subsubcategory->isEmpty()) <option selected="" disabled value="{{ $subsubcategory[0]->id }}">{{ $subsubcategory[0]->name }}</option> @endif
                            </select>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="stock">Stok <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="stock" name="stock" type="text" data-type="currency" value="{{ $product->stock }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="description">Deskripsi <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <textarea id="description" class="form-control" name="description" readonly>{{ $product->product->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="short_description">Deskripsi Singkat <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <textarea id="short_description" class="form-control" name="short_description" readonly>{{ $product->product->short_description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="sku">Foto 1 <i class="text-danger">*</i></label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file" style="border:1px solid #00555555;">
                                        Browse… <input type="file" id="imgInp" name="image" readonly>
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="vendor_sku">Foto 2 <i class="text-danger">*</i></label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file" style="border:1px solid #00555555;">
                                        Browse… <input type="file" id="imgInp2" name="small_image" readonly>
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="vendor_sku">Foto 3 <i class="text-danger">*</i></label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file" style="border:1px solid #00555555;">
                                        Browse… <input type="file" id="imgInp3" name="thumbnail" readonly>
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <img class="col-md-12" style="border:1px solid #33555555;" id='img-upload' @if($product->product->image != null) src="{{ $style->url_image }}{{ $product->product->image }}" @else src="{{ asset('techone/images/placeholder.png') }}" @endif/>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <img class="col-md-12" style="border:1px solid #33555555;" id="img-upload-2" @if($product->product->small_image != null) src="{{ $style->url_image }}{{ $product->product->small_image }}" @else src="{{ asset('techone/images/placeholder.png') }}" @endif/>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <img class="col-md-12" style="border:1px solid #33555555;" id="img-upload-3" @if($product->product->thumbnail != null) src="{{ $style->url_image }}{{ $product->product->thumbnail }}" @else src="{{ asset('techone/images/placeholder.png') }}" @endif/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="product_group">Group Produk <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select2-multiple select2-hidden-accessible" data-placeholder="Group Produk" name="product_group[]" id="product_group"multiple="" data-select2-id="select2-2" tabindex="-1" aria-hidden="true" disabled>
                                <option></option>
                                @foreach($product_group_rules as $pgr)
                                    <option value="{{ $pgr->id }}"
                                        @foreach($product->product_group()->get() as $pg)
                                            @if($pg->rule_id == $pgr->id)
                                            selected
                                            @endif
                                        @endforeach
                                    >{{ $pgr->rule_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    
                    <h5 class="card-title" style="margin-top:40px;">
                        <b>Biaya Pengiriman</b>
                        <button type="button" id="add_product_shipping" class="btn btn-primary pull-right" disabled>
                            <i class="fa fa-plus-square"></i>
                        </button>
                    </h5>
                    <hr>
                    <div class="form-group row">
                        <fieldset class="form-group col-md-12">
                            <table class="table table-hover col-md-12" id="table_product_shipping" style="border: none;">
                                <tbody style="border: none;">
                                    <?php 
                                        $product_shipping = new \App\Product\ProductShipping;
                                        $product_shipping = $product_shipping->where('product_id', $product->product_id)->get();
                                    ?>
                                    @foreach($product_shipping as $ps)
                                    <tr style="border: none;">
                                        <td width="47.5%" style="border: none;">
                                            <input type="text" class="form-control" id="name_biaya[]" name="name_biaya[]" value="{{ $ps->name }}" readonly>
                                        </td>
                                        <td width="47.5%" style="border: none;">
                                            <input type="text" class="form-control" data-type="currency" id="price_biaya[]" name="price_biaya[]" value="{{ number_format($ps->price, 0) }}" readonly>
                                        </td>
                                        <td width="5%" class="text-right" style="border: none;">
                                            <button type="button" class="btn btn-danger hapus" disabled><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                    <input class="switch-input" type="checkbox" id="status_product" name="status_product" onclick="checkBox()" @if($product->status == 1) value="1" checked @else value="0" @endif disabled>
                                    <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                                </label>
                                &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">@if($product->status == 1) Aktif @else Tidak Aktif @endif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a class="btn btn-danger" href="{{ route('vendor.product', [Auth::user()->group->code, Crypt::encryptString('product')]) }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    @foreach ($errors->all() as $error)
        toastr.error("{{$error}}")
    @endforeach
    var subcategory_id;

    var description = document.getElementById("description");
    CKEDITOR.replace(description,{
        language:'en-gb'
    });
    var short_description = document.getElementById("short_description");
    CKEDITOR.replace(short_description,{
        language:'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.config.width = '100%';

    function checkBox() {
        if (document.getElementById('status_product').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
        document.getElementById('status_product').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_product').value = 0;
        }
    }
    $(document).ready(function () {
        $('#product_group').select2({
            allowClear: false,
            theme: 'bootstrap',
            width: "100%",
            placeholder: "Pilih Group",
        });
        $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});

        $(document).on('change', '.btn-file-2 :file', function() {
            var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
		});

		$('.btn-file-2 :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL2(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload-2').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp2").change(function(){
		    readURL2(this);
		});

        $(document).on('change', '.btn-file-3 :file', function() {
            var input = $(this), label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
		});

		$('.btn-file-3 :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL3(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload-3').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp3").change(function(){
		    readURL3(this);
		});
    });

    $('.select2').select2({
        allowClear: false,
        theme: 'bootstrap',
        width: "100%",
        placeholder: "Pilih Wilayah",
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
</script>
@endpush