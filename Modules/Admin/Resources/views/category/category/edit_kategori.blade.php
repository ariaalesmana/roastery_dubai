@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Kategori</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <input id="category_id" name="category_id" type="hidden" value="{{ $category->id }}">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="first_name">Kategori</label>
                    <div class="col-md-10">
                        <input class="form-control" id="first_name" name="first_name" type="text" value="{{ $category->name }}">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                <input class="switch-input" type="checkbox" id="status_category" name="status_category" onclick="checkBox()" @if($category->status == 1) value="1" checked @else value="0" @endif>
                                <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                            </label>
                            &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">@if($category->status == 1) Aktif @else Tidak Aktif @endif</label>
                        </div>
                    </div>
                </div>
                
                <h5 class="card-title" style="margin-top:40px;"><b>Relasi Pada Produk</b></h5>
                <hr>
                <div class="table-responsive">
                    <table id="tabel-relation_product" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align:middle">No</th>
                                <th class="text-center" style="vertical-align:middle">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($relation_product as $rp)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>@if(isset($rp->product)) {{ $rp->product->name }} @endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $relation_product->render() !!}
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary float-right" type="submit">
                    Simpan
                </button>
                <a class="btn btn-danger" href="{{ route('admin.category', [Auth::user()->group->code, Crypt::encryptString('category')]) }}">Kembali</a>
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

    var table_relation_product = null;
    table_relation_product =  $('#tabel-relation_product').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })

    function checkBox() {
        if (document.getElementById('status_category').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
            document.getElementById('status_category').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_category').value = 0;
        }
    }    
</script>
@endpush