@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar Customer</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right" style="margin-left:5px;">
                                <a class="btn btn-success"  href="{{ route('admin.customer.create', [Auth()->user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString('customer')]) }}">
                                    Tambah Customer
                                </a>
                                <a href="{{ route('admin.customer', [Auth()->user()->group->code, Crypt::encryptString('customer')]) }}">
                                    <button class="btn btn-warning my-2 my-sm-0" type="button" 
                                        style='color:#fff'> Reset
                                    </button>
                                </a>&nbsp;&nbsp;
                            </div>
                            <form class="form-inline pull-right" method="get" action="{{ route('admin.customer.search', [Auth()->user()->group->code]) }}">
                                <input class="form-control mr-sm-2" type="text" name="q" placeholder="Pencarian..">
                                <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel-customer" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama</th>
                                    <th class="text-center" style="vertical-align:middle">Email</th>
                                    <th class="text-center" style="vertical-align:middle">Group</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer as $c)
                                <tr>
                                    <?php 
                                        $customer_group = $c->customer_grouping()->get();
                                        $customer_grouping = array();
                                    ?>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $c->first_name }} {{ $c->last_name }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>
                                        @foreach($customer_group as $cg)
                                            <label class="badge badge-warning" style="color:white">{{ $cg->customer_group->customer_group_code }}</label> 
                                            <?php array_push($customer_grouping, $cg->customer_group->customer_group_code); ?>
                                        @endforeach
                                    </td>
                                    <td style="vertical-align:middle" align="center">
                                        <a class="btn btn-sm btn-primary hover" href="{{ route('admin.customer.show', [Auth()->user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString($c->id)]) }}">
                                            <i class="fa fa-eye ihover" style="color:white"><span class='span'>&nbsp;Lihat</span></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning hover" href="{{ route('admin.customer.edit', [Auth()->user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString($c->id)]) }}">
                                            <i class="fa fa-edit ihover" style="color:#fff"><span class='span'>&nbsp;Edit</span></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger hover">
                                            <i class="fa fa-trash-o ihover" style="color:white"><span class='span'>&nbsp;Hapus</span></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $customer->render() !!}
                    </div>
                </div>
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

    var table_customer = null;
    table_customer =  $('#tabel-customer').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
    
    function showCustomer(first_name, middle_name, last_name, email, gender, status, street, city, region, postcode, telephone, fax, customer_grouping) {
        var customer_group = JSON.parse(customer_grouping);
        var group = '';
        var status_costumer = "";
        var jenis_kelamin = "";
        if (status == 1) {
            status_costumer = '<label style="vertical-align:middle;color:white;" class="badge badge-success text-center pull-right">Aktif</label>';
        } else {
            status_costumer = '<label style="vertical-align:middle;color:white;" class="badge badge-warning text-center pull-right">Tidak Aktif</label>';
        }
        if (gender == 1) {
            jenis_kelamin = 'Laki-laki';
        } else if (gender == 2) {
            jenis_kelamin = 'Perempuan';
        }
        for(var i = 0; i < customer_group.length; i++) {
            group += '<label class="badge badge-warning">'+customer_group[i]+'</label>&nbsp;';
        }
        Swal.fire({
            customClass: 'swal-wide',
            html: `	<div style="z-index:9999999;padding:0;margin:0;">
                        <div class="modal-dialog modal-xl modal-primary" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Detail Customer</h4>
                                    `+status_costumer+`
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Nama Depan</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-id-card-o"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+first_name+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Nama Tengah</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-id-card-o"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+middle_name+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Nama Belakang</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-id-card-o"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+last_name+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Jenis Kelamin</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-venus"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+jenis_kelamin+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-envelope-o"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+email+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Alamat</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-street-view"></i>
                                                    </span>
                                                    <textarea class="form-control" id="date" type="text" disabled>`+street+`</textarea>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Kota</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-map-pin"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+city+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Region</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-map-pin"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+region+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Kode Pos</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-map-pin"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+postcode+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">No. telepon</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-phone"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+telephone+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Fax</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="c-icon fa fa-lg fa-fax"></i>
                                                    </span>
                                                    <input class="form-control" id="date" type="text" value="`+fax+`" disabled>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12">
                                            <fieldset class="form-group">
                                                <label class="pull-left" style="font-size:16px;font-weight:600;">Group</label>
                                                <div class="input-group">
                                                    `+group+`
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="tutupSwal" class="btn btn-md btn-danger float-right"><i class="fa fa-times"></i> Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>`,
            onOpen: function() {
                $('#tutupSwal').click(function(){
                    swal.close(); return false;
                });
            },
            showCancelButton: false,
            showConfirmButton: false
        })
    }
</script>
@endpush