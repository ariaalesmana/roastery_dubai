@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb row">
    <li class="col-md-12 breadcrumb-item">
        Daftar Customer
        <div class="pull-right">
            <form class="form-inline pull-right" action="{{ url()->current() }}">
                <a href="{{ route('admin.customer', [Auth()->user()->group->code, Crypt::encryptString('customer')]) }}" class="btn btn-danger" style='color:#fff'> Reset</a>&nbsp;
                <input class="form-control" type="text" name="keyword" placeholder="Cari.." value="{{ $keyword }}">&nbsp;
                <button class="btn btn-primary" type="submit">Cari</button>&nbsp;
                <a href="{{ route('admin.customer.create', [Auth::user()->group->code, Crypt::encryptString('customer')]) }}" class="btn btn-success">
                    <span class="span">&nbsp;Tambah</span></i>
                </a>
            </form>
        </div>
    </li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="table-responsive">
                        <table id="tabel-customer" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Nama</th>
                                    <th class="text-center" style="vertical-align:middle">Email</th>
                                    <th class="text-center" style="vertical-align:middle">Group</th>
                                    <th width="15%" class="text-center" style="vertical-align:middle">Aksi</th>
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
                                        <a class="btn btn-warning" data-placement="left" title="Detail" href="{{ route('admin.customer.edit', [Auth::user()->group->code, Crypt::encryptString($c->id)]) }}">
                                            <i class="fa fa-eye" style="color:#fff"></i>
                                        </a>
                                        <a class="btn btn-danger" data-placement="right" title="Hapus">
                                            <i class="fa fa-trash-o" style="color:white"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $customer->links() !!}
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

    $(document).ready(function() {
        $('#tabel-customer .btn').tooltip();
    })
</script>
@endpush