@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar Order</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right" style="margin-left:5px;">
                                <a href="{{ route('admin.orders.order', [Auth()->user()->group->code, Crypt::encryptString('adminorder')]) }}">
                                    <button class="btn btn-warning my-2 my-sm-0" type="button" 
                                        style='color:#fff'> Reset
                                    </button>
                                </a>&nbsp;&nbsp;
                            </div>
                            <form class="form-inline pull-right" method="get" action="{{ route('admin.orders.order.search', [Auth()->user()->group->code]) }}">
                                <input class="form-control mr-sm-2" type="text" name="q" placeholder="Pencarian..">
                                <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel-order" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">No Order</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Pekerjaan</th>
                                    <th class="text-center" style="vertical-align:middle">No PR</th>
                                    <th class="text-center" style="vertical-align:middle">Status</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $o)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-left">{{ $o->order_number }}</td>
                                    <td class="text-left">{{ $o->name }}</td>
                                    <td class="text-left">{{ $o->no_pr }}</td>
                                    <td class="text-center">
                                        @if($o->status == 0)
                                            <label style="vertical-align:middle; color:white;" class="badge badge-warning text-center">Pending</label> 
                                        @elseif($o->status == 1)
                                            <label style="vertical-align:middle; color:white;" class="badge badge-success text-center">Disetujui</label> 
                                        @elseif($o->status == 2)
                                            <label style="vertical-align:middle; color:white;" class="badge badge-danger text-center">Ditolak</label> 
                                        @endif
                                    </td>
                                    <td style="vertical-align:middle" align="center">
                                        <a class="btn btn-sm btn-primary hover" href="{{ route('admin.orders.order_show', [Auth::user()->group->code, Crypt::encryptString($o->id)]) }}">
                                            <i class="fa fa-eye ihover" style="color:white"><span class='span'>&nbsp;Lihat</span></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $order->render() !!}
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

    var table_order = null;
    table_order =  $('#tabel-order').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
</script>
@endpush