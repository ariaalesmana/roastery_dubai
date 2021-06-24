@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Tambah Kategori</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.category_create_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="name">Kategori</label>
                        <div class="col-md-10">
                            <input class="form-control" id="name" name="name" type="text">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="stock">Status <i class="text-danger">*</i></label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <label class="col-form-label switch switch-md switch-label switch-pill switch-primary">
                                    <input class="switch-input" type="checkbox" id="status_category" name="status_category" onclick="checkBox()" value="0">
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
                    <a class="btn btn-danger" href="{{ route('admin.category', [Auth::user()->group->code, Crypt::encryptString('category')]) }}">Kembali</a>
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