@extends('vendor::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar Produk</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-inline pull-right" method="get">
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
                                    <th class="text-center" style="vertical-align:middle">Nama Pemesan</th>
                                    <th class="text-center" style="vertical-align:middle">Pemesanan Dari</th>
                                    <th class="text-center" style="vertical-align:middle">Status</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $o)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-left">{{ $o->order_number }}</td>
                                    <td class="text-left">{{ $o->customer->first_name }} {{ $o->customer->last_name }}</td>
                                    <td class="text-left">{{ $o->group->name }}</td>
                                    <td class="text-center">
                                        @if($o->order_status->name == 'Pending')
                                            <label style="vertical-align:middle; color:white;" class="badge badge-warning text-center">{{ $o->order_status->name }}</label>
                                        @elseif($o->order_status->name == 'Ditolak')
                                            <label style="vertical-align:middle" class="badge badge-danger text-center">{{ $o->order_status->name }}</label>
                                        @elseif($o->order_status->name == 'Telah Dikonfirmasi')
                                            <label style="vertical-align:middle" class="badge badge-primary text-center">{{ $o->order_status->name }}</label>
                                        @elseif($o->order_status->name == 'Selesai')
                                            <label style="vertical-align:middle" class="badge badge-success text-center">{{ $o->order_status->name }}</label>
                                        @endif
                                    </td>
                                    <td class="text-center" style="vertical-align:middle">
                                        <a class="btn btn-sm btn-primary hover" href="{{ route('vendor.order.detail', [Auth()->user()->group->code, Illuminate\Support\Facades\Crypt::encryptString($o->id)]) }}">
                                            <i class="fa fa-eye ihover" style="color:white"><span class='span'>&nbsp;Lihat</span></i>
                                        </a>
                                        {{-- <a class="btn btn-sm btn-danger hover">
                                            <i class="fa fa-trash-o ihover" style="color:white"><span class='span'>&nbsp;Hapus</span></i>
                                        </a> --}}
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