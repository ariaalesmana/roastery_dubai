@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Sub Kategori</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <input id="subcategory_id" name="subcategory_id" type="hidden" value="{{ $subcategory->id }}">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="email">Kategori</label>
                    <div class="col-md-10">
                        <select class="form-control select2" data-placeholder="Kategori" name="category" id="category" disabled>
                            <option></option>
                            @foreach($category as $c)
                                <option value="{{ $c->id }}"
                                @if($subcategory->parent_id == $c->id)
                                selected
                                @endif
                                >{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="subcategory">Sub Kategori</label>
                    <div class="col-md-10">
                        <input class="form-control" id="subcategory" name="subcategory" type="text" value="{{ $subcategory->name }}" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                <input class="switch-input" type="checkbox" id="status_subcategory" name="status_subcategory" onclick="checkBox()" @if($subcategory->status == 1) value="1" checked @else value="0" @endif disabled>
                                <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                            </label>
                            &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">@if($subcategory->status == 1) Aktif @else Tidak Aktif @endif</label>
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
                <a class="btn btn-danger" href="{{ route('admin.subcategory', [Auth::user()->group->code, Crypt::encryptString('subcategory')]) }}">Kembali</a>
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
        if (document.getElementById('status_subcategory').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
            document.getElementById('status_subcategory').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_subcategory').value = 0;
        }
    }    
</script>
@endpush