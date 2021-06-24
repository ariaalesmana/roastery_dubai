@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar PO</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right" style="margin-left:5px;">
                                <a href="{{ route('admin.orders.po', [Auth()->user()->group->code, Crypt::encryptString('adminpo')]) }}">
                                    <button class="btn btn-warning my-2 my-sm-0" type="button" 
                                        style='color:#fff'> Reset
                                    </button>
                                </a>&nbsp;&nbsp;
                            </div>
                            <form class="form-inline pull-right" method="get" action="{{ route('admin.orders.po.search', [Auth()->user()->group->code]) }}">
                                <input class="form-control mr-sm-2" type="text" name="q" placeholder="Pencarian..">
                                <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel-po" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">No PO</th>
                                    <th class="text-center" style="vertical-align:middle">Nama Pekerjaan</th>
                                    <th class="text-center" style="vertical-align:middle">No PR</th>
                                    <th class="text-center" style="vertical-align:middle">Tanggal PO</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($po as $p)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $p->po_number }}</td>
                                    <td>{{ $p->nama_pekerjaan }}</td>
                                    <td>{{ $p->no_pr }}</td>
                                    <td>{{ date('d-M-Y', strtotime($p->po_date)) }}</td>
                                    <td style="vertical-align:middle" align="center">
                                        <a class="btn btn-sm btn-primary hover" href="{{ route('admin.orders.po_show', [Auth::user()->group->code, Crypt::encryptString($p->id)]) }}">
                                            <i class="fa fa-eye ihover" style="color:white"><span class='span'>&nbsp;Lihat</span></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $po->render() !!}
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

    var table_po = null;
    table_po =  $('#tabel-po').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
</script>
@endpush