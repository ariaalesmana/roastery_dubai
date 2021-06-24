@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Sub Sub Kategori</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <input id="subsubcategory_id" name="subsubcategory_id" type="hidden" value="{{ $subsubcategory->id }}">
            <div class="card-body">
                <?php
                    $parent_subcat = 0;
                ?>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="email">Kategori</label>
                    <div class="col-md-10" id="cat">
                        <select class="form-control select2" data-placeholder="Kategori" name="category" id="category" disabled>
                            <option></option>
                            @foreach($category as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="email">Sub Kategori</label>
                    <div class="col-md-10">
                        <select class="form-control select2" data-placeholder="Sub Kategori" name="subcategory" id="subcategory" disabled>
                            <option></option>
                            @foreach($subcategory as $sc)
                                <option value="{{ $sc->id }}"
                                @if($subsubcategory->parent_id == $sc->id)
                                selected
                                <?php $parent_subcat = $sc->parent_id ?>
                                @endif
                                >{{ $sc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="subsubcategory">Sub Sub Kategori</label>
                    <div class="col-md-10">
                        <input class="form-control" id="subsubcategory" name="subsubcategory" type="text" value="{{ $subsubcategory->name }}" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                <input class="switch-input" type="checkbox" id="status_subsubcategory" name="status_subsubcategory" onclick="checkBox()" @if($subsubcategory->status == 1) value="1" checked @else value="0" @endif disabled>
                                <span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
                            </label>
                            &nbsp;&nbsp;&nbsp;<label id="status_name" name="status_name" class="col-form-label">@if($subsubcategory->status == 1) Aktif @else Tidak Aktif @endif</label>
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
                <a class="btn btn-danger" href="{{ route('admin.subsubcategory', [Auth::user()->group->code, Crypt::encryptString('subsubcategory')]) }}">Kembali</a>
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


    var table_relation_product = null;
    table_relation_product =  $('#tabel-relation_product').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
    
    $(document).ready(function() {
        console.log('{{ $parent_subcat }}')
        $('#cat').empty();
        var html = 
        `<select class="form-control select2" data-placeholder="Kategori" name="category" id="category">
            <option></option>
            @foreach($category as $c)
                <option value="{{ $c->id }}"
                @if($parent_subcat == $c->id)
                selected
                @endif
                >{{ $c->name }}</option>
            @endforeach
        </select>`;
        $('#cat').append(
            html
        );
    
        $('.select2').select2({
            allowClear: false,
            theme: 'bootstrap',
            width: "100%",
        });
    });

    function checkBox() {
        if (document.getElementById('status_subsubcategory').checked) {
            document.getElementById('status_name').innerHTML = "Aktif";
            document.getElementById('status_subsubcategory').value = 1;
        } else {
            document.getElementById('status_name').innerHTML = "Tidak Aktif";
            document.getElementById('status_subsubcategory').value = 0;
        }
    }    
</script>
@endpush