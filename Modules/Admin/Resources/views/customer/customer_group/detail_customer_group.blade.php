@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Customer Group</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <form id="forms" method="post" action="{{ route('admin.customer_group.edit_post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
            {{ csrf_field() }}
            <div class="card">
                <input id="customer_group_id" name="customer_group_id" type="hidden" value="{{ $customer_group->id }}">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="first_name">Nama</label>
                        <div class="col-md-10">
                            <input class="form-control @if($errors->has('customer_group_code')) is-invalid @endif" id="customer_group_code" name="customer_group_code" type="text" value="{{ $customer_group->customer_group_code }}">
                            <em id="firstname-error" class="error invalid-feedback">Masukkan Nama Group</em>
                        </div>
                    </div>
                    
                    <h5 class="card-title" style="margin-top:40px;"><b>Relasi Pada Customer</b></h5>
                    <hr>
                    <div class="table-responsive">
                        <table id="tabel-relation_customer" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama</th>
                                    <th class="text-center" style="vertical-align:middle">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($relation_customer as $rc)
                                <tr>
                                    <td class="text-center">{{ ++$a }}</td>
                                    <td>{{ $rc->customer->first_name }} {{ $rc->customer->last_name }}</td>
                                    <td>{{ $rc->customer->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $relation_customer->render() !!}
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
                        @if(count($relation_product) > 0)
                        {!! $relation_product->render() !!}
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary float-right" type="submit">
                        Simpan
                    </button>
                    <a class="btn btn-danger" href="{{ route('admin.customer_group', [Auth::user()->group->code, Crypt::encryptString('customer_group')]) }}">Kembali</a>
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

    var table_relation_customer = null;
    table_relation_customer =  $('#tabel-relation_customer').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })

    var table_relation_product = null;
    table_relation_product =  $('#tabel-relation_product').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })

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