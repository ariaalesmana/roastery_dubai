@extends('vendor::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Tambah Produk</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('vendor.product.contract.add_product_post', [Auth::user()->group->code, $vendor_contract_master->id]) }}" enctype="multipart/form-data" role="form">
            <div class="card">
                {{ csrf_field() }}
                <input class="form-control" id="vendor_master_id" name="vendor_master_id" type="hidden" value="{{ $vendor_contract_master->vendor_master_id }}">
                <input class="form-control" id="vendor_contract_master_id" name="vendor_contract_master_id" type="hidden" value="{{ $vendor_contract_master->id }}">
                <input class="form-control" id="category" name="category" type="hidden" value="{{ $vendor_contract_master->category }}">
                <div class="card-body">
                    <h5 class="card-title"><b>Detail Kontrak</b></h5>
                    <hr>
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
                        <label class="col-md-2 col-form-label" for="contract_start">Tanggal Awal Kontrak</label>
                        <div class="col-md-4">
                            <input class="form-control" id="contract_start" name="contract_start" type="text" value="{{ date('d-M-Y', strtotime($vendor_contract_master->contract_start)) }}" readonly>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="contract_end">Tanggal Akhir Kontrak</label>
                        <div class="col-md-4">
                            <input class="form-control" id="contract_end" name="contract_end" type="text" value="{{ date('d-M-Y', strtotime($vendor_contract_master->contract_end)) }}" readonly>
                        </div>
                    </div>

                    
                    <h5 class="card-title" style="margin-top:40px;"><b>Detail Produk</b></h5>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">Upload QRCode</label>
                        <div class="col-md-4">
                            <input type="file" name="qr" id="qr" class="form-control" accept="jpg, jpeg, png">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">Nama Produk <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <textarea rows="3" class="form-control" id="name" name="name" type="text"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="price">Harga <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="price" name="price" type="text" data-type="currency" value="">
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="unit">Satuan <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="unit" name="unit" type="text" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="sku">SKU <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="sku" name="sku" type="text" value="">
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="vendor_sku">Vendor SKU <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="vendor_sku" name="vendor_sku" type="text" value="">
                        </div>
                    </div>
                    <?php 
                        $sub_category = new \App\Category\Category;
                        $sub_category = $sub_category->setConnection(Auth()->user()->group->katalog);
                        $sub_category = $sub_category->where("parent_id", $category->id)->where("level", 3)->where("status", 1)->get();
                    ?>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="category">Kategori <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2" data-placeholder="Kategori" name="category" id="category" disabled>
                                <option selected="" disabled value="{{ $category->id }}">{{ $category->name }}</option>
                            </select>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="subcategory">Sub Kategori <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <select class="custom-select val-custom form-control select2" data-placeholder="Sub Kategori" name="subcategory" id="subcategory" onchange="myFunctionSubCategory()">
                                <option></option>
                                @foreach($sub_category as $sc)
                                <option value="{{ $sc->id }}">{{ $sc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        {{-- <label class="col-md-2 col-form-label" for="subsubcategory">Sub Sub Kategori <i class="text-danger">*</i></label> --}}
                        <label class="col-md-2 col-form-label" for="subsubcategory">Sub Sub Kategori </label>
                        <div class="col-md-4" id="idsubsubcategory">
                            <select class="custom-select val-custom form-control select2" data-placeholder="Sub Sub Kategori" name="subsubcategory" id="subsubcategory">
                                <option></option>
                            </select>
                        </div>
                        <label class="col-md-2 col-form-label text-right" for="stock">Stok <i class="text-danger">*</i></label>
                        <div class="col-md-4">
                            <input class="form-control" id="stock" name="stock" type="text" data-type="currency" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="description">Deskripsi <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <textarea id="description" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="short_description">Deskripsi Singkat <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <textarea id="short_description" class="form-control" name="short_description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="sku">Foto 1 <i class="text-danger">*</i></label>
                        <div class="col-md-2">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file" style="border:1px solid #00555555;">
                                        Browse… <input type="file" id="imgInp" name="image">
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
                                        Browse… <input type="file" id="imgInp2" name="small_image">
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
                                        Browse… <input type="file" id="imgInp3" name="thumbnail">
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <img class="col-md-12" style="border:1px solid #33555555;" id='img-upload' src="{{ asset('techone/images/placeholder.png') }}"/>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <img class="col-md-12" style="border:1px solid #33555555;" id="img-upload-2" src="{{ asset('techone/images/placeholder.png') }}"/>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <img class="col-md-12" style="border:1px solid #33555555;" id="img-upload-3" src="{{ asset('techone/images/placeholder.png') }}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="product_group">Group Produk <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <select class="form-control select2 select2-multiple select2-hidden-accessible" data-placeholder="Group Produk" name="product_group[]" id="product_group"multiple="" data-select2-id="select2-2" tabindex="-1" aria-hidden="true">
                                <option></option>
                                @foreach($product_group_rules as $pgr)
                                    <option value="{{ $pgr->id }}">{{ $pgr->rule_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    
                    <h5 class="card-title" style="margin-top:40px;">
                        <b>Biaya Pengiriman</b>
                        <button type="button" id="add_product_shipping" class="btn btn-primary pull-right">
                            <i class="fa fa-plus-square"></i>
                        </button>
                    </h5>
                    <hr>
                    <div class="form-group row">
                        <fieldset class="form-group col-md-12">
                            <table class="table table-hover col-md-12" id="table_product_shipping" style="border: none;">
                                <tbody style="border: none;">
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                    <input class="switch-input" type="checkbox" id="status_product" name="status_product" onclick="checkBox()">
                                    <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                                </label>
                                &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">
                        Simpan
                    </button>
                    <a class="btn btn-danger" href="{{ route('vendor.product.contract', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('product_contract')]) }}">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    // scanner qrcode
    // let opts = {
    //     continuous: true,
    //     mirror:true,
    //     captureImage: false,
    //     backgroundScan: true,
    //     refractoryPeriod: 5000,
    //     scanPeriod: 1
    // }
    // let scanner = new Instascan.Scanner({ video:document.getElementById('preview') });
    // Instascan.Camera.getCameras().then(function(cameras){
    //     if(cameras.length > 0){
    //         console.log(cameras);
    //         scanner.start(cameras[0]);
    //     } else {
    //         $('#scanField').css('display', 'none');
    //         alert('No cameras found');
    //         scanner.stop();
    //     }
    // }).catch(function(e){
    //     console.error(e);
    // });

    // scanner.addListener('scan', function(c){
    //     document.getElementById('qr').value = c;
    //     window.open(c, '_blank');
    // });    
</script>
<script>
    @foreach ($errors->all() as $error)
        toastr.error("{{$error}}")
    @endforeach

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

    function myFunctionSubCategory() {
        subcategory_id = document.getElementById('subcategory').value;
        $.ajax({
            type : 'GET',
            url : '{{ route('vendor.product.subcategory', [Auth::user()->group->code]) }}',
            data : {
                id : subcategory_id
            },
            success:function(response){
                response = JSON.parse(response);
                var html = `<select class="custom-select val-custom form-control select2" data-placeholder="Sub Sub Kategori" name="subsubcategory" id="subsubcategory">
                                <option></option>`;
                for(var i = 0; i < response.length; i++) {
                    html+=`     <option value="` + response[i].id + `">` + response[i].name + `</option>`;
                }
                html+=`     </select>`;

                document.getElementById("idsubsubcategory").innerHTML = html;
                
                $('.select2').select2({
                    allowClear: false,
                    theme: 'bootstrap',
                    width: "100%"
                });
            }
        });
    }

    function checkBox() {
        if (document.getElementById('status_product').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
        document.getElementById('status_product').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_product').value = 0;
        }
    }

    $("#add_product_shipping").click(function() {
        $("#table_product_shipping tbody").append(
            '<tr>' +
                '<td width="47.5%"><input type="text" class="form-control" id="name_biaya[]" name="name_biaya[]"></td>' +
                '<td width="47.5%"><input type="text" class="form-control" data-type="currency" id="price_biaya[]" name="price_biaya[]"></td>' +
                '<td width="5%"><button type="button" class="btn btn-sm btn-danger hapus"><i class="fa fa-trash"></i></button></td>' +
            "</tr>"
        );

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            }
        });
    });

    $('body').on('click', '.hapus', function() {
        $(this).parents('.tr').remove();
    });

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