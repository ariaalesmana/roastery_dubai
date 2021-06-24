@extends('admin::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Daftar Sub Kategori</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-body">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right" style="margin-left:5px;">
                                <a class="btn btn-success"  href="{{ route('admin.customer.create', [Auth::user()->group->code, Crypt::encryptString('customer')]) }}">
                                    Tambah Sub Kategori
                                </a>
                                <a href="{{ route('admin.subcategory', [Auth()->user()->group->code, Crypt::encryptString('subcategory')]) }}">
                                    <button class="btn btn-warning my-2 my-sm-0" type="button" 
                                        style='color:#fff'> Reset
                                    </button>
                                </a>&nbsp;&nbsp;
                            </div>
                            <form class="form-inline pull-right" method="get" action="{{ route('admin.subcategory_search', [Auth()->user()->group->code]) }}">
                                <input class="form-control mr-sm-2" type="text" name="q" placeholder="Pencarian..">
                                <button class="btn btn-primary my-2 my-sm-0" type="submit">Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel-subcategory" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" style="vertical-align:middle">No</th>
                                    <th class="text-center" style="vertical-align:middle">Kategori</th>
                                    <th class="text-center" style="vertical-align:middle">Sub Kategori</th>
                                    <th class="text-center" style="vertical-align:middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategory as $sc)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $sc->category->name }}</td>
                                    <td>{{ $sc->name }}</td>
                                    <td style="vertical-align:middle" align="center">
                                        <a class="btn btn-sm btn-primary hover" href="{{ route('admin.subcategory_show', [Auth::user()->group->code, Crypt::encryptString($sc->id)]) }}">
                                            <i class="fa fa-eye ihover" style="color:white"><span class='span'>&nbsp;Lihat</span></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning hover" href="{{ route('admin.subcategory_edit', [Auth::user()->group->code, Crypt::encryptString($sc->id)]) }}">
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
                        {!! $subcategory->render() !!}
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

    var table_subcategory = null;
    table_subcategory =  $('#tabel-subcategory').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })
</script>
@endpush