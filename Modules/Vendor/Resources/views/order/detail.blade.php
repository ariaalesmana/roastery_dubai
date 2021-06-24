@extends('vendor::layouts.app')
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Detail Pemesanan</li>
</ol>
<div class="container-fluid" style="margin-top:16px;">
    <div class="animated fadeIn">
        <div class="card">
            <input id="order_id" name="order_id" type="hidden" value="{{ $order->id }}">
            <div class="card-body">

                <h5 class="card-title" style="margin-top:20px;"><b>Detail Order</b></h5>
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="order_number">No Order</label>
                    <div class="col-md-10">
                        <input class="form-control" id="order_number" name="order_number" type="text" value="{{ $order->order_number }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="name">Nama Pekerjaan</label>
                    <div class="col-md-10">
                        <input class="form-control" id="name" name="name" type="text" value="{{ $order->name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="no_pr">No PR</label>
                    <div class="col-md-10">
                        <input class="form-control" id="no_pr" name="no_pr" type="text" value="{{ $order->no_pr }}" readonly>
                    </div>
                </div>

                <h5 class="card-title" style="margin-top:40px;"><b>Detail Pemesan</b></h5>
                <hr>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="first_name">Nama</label>
                    <div class="col-md-10">
                        <input class="form-control" id="first_name" name="first_name" type="text" value="{{ $order->order_address->first_name }} {{ $order->order_address->last_name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="email">Email</label>
                    <div class="col-md-10">
                        <input class="form-control" id="email" name="email" type="email" value="{{ $order->order_address->email }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="company">Perusahaan</label>
                    <div class="col-md-10">
                        <input class="form-control" id="company" name="company" type="text" value="{{ $order->order_address->company }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="address">Alamat</label>
                    <div class="col-md-10">
                        <textarea rows="3" class="form-control" id="address" name="address" type="text" readonly>{{ $order->order_address->address }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="telephone">No Telepon</label>
                    <div class="col-md-4">
                        <input class="form-control" id="telephone" name="telephone" type="text" value="{{ $order->order_address->phone }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="fax">Fax</label>
                    <div class="col-md-4">
                        <input class="form-control" id="fax" name="fax" type="text" value="{{ $order->order_address->fax }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="province">Provinsi</label>
                    <div class="col-md-10">
                        <input class="form-control" id="province" name="province" type="text" value="{{ $order->order_address->province }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="city">Kota</label>
                    <div class="col-md-4">
                        <input class="form-control" id="city" name="city" type="text" value="{{ $order->order_address->city }}" readonly>
                    </div>
                    <label class="col-md-2 col-form-label text-right" for="postcode">Kode Pos</label>
                    <div class="col-md-4">
                        <input class="form-control" id="postcode" name="postcode" type="text" value="{{ $order->order_address->postcode }}" readonly>
                    </div>
                </div>
                
                <h5 class="card-title" style="margin-top:40px;"><b>Detail Produk</b></h5>
                <hr>
                <div class="table-responsive">
                    <table id="tabel-cart" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align:middle">No</th>
                                <th class="text-center" style="vertical-align:middle">Produk</th>
                                <th class="text-center" style="vertical-align:middle">Jumlah</th>
                                <th class="text-center" style="vertical-align:middle">Harga Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalproduk = 0; ?>
                            @foreach ($order->order_detail as $od)
                            <tr>
                                <td class="text-center" @if(count($od->order_shipping) != 0) rowspan="{{ count($od->order_shipping) + 2 }}" @else rowspan="1" @endif>{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $od->name }}</td>
                                <td class="text-center">{{ $od->qty }}</td>
                                <td class="text-right">{{ number_format($od->price) }}</td>
                                <?php $totalproduk +=  $od->qty * $od->price ?>
                                @if(count($od->order_shipping) != 0)
                                <tr style="border-top:none;">
                                    <td style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="3">
                                        <span class="label-text" style="text-align:left; font-weight: bold">Biaya Pengiriman</span>
                                    </td>
                                </tr>
                                @foreach($od->order_shipping as $os)
                                <tr style="border-top:none;border-bottom:none;">
                                    <td class="product-name" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="2">
                                        {{ $os->name }}
                                    </td>
                                    <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" class="price" align="right">
                                        {{ number_format($os->price, 0) }}
                                    </td>
                                </tr>
                                <?php $totalproduk +=  $os->price ?>
                                @endforeach
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" style="font-weight:bold;vertical-align:middle;" align="left" colspan="3">Total</td>
                                <td class="total text-right" colspan="1">Rp. {{ number_format($totalproduk, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($order->order_status->name == 'Pending')
                <button class="btn btn-primary float-right" onclick="showModalCatatan({{ $order->id }}, 1)">
                    Konfirmasi
                </button>
                <button class="btn btn-danger float-right" style="margin-right:10px;" onclick="showModalCatatan({{ $order->id }}, -1)">
                    Tolak
                </button>
                <button class="btn btn-warning float-right" style="margin-right:10px;color:white;" onclick="showModalCatatanVendor({{ $order->order_number }}, 1)">
                    Catatan
                </button>
                @elseif($order->order_status->name != 'Selesai')
                <button class="btn btn-warning float-right" style="margin-right:10px;color:white;" onclick="showModalCatatanVendor({{ $order->order_number }}, 1)">
                    Catatan
                </button>
                @endif
                <a class="btn btn-danger" href="{{ route('vendor.order', [Auth()->user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString('vendororder')]) }}">Kembali</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="catatan-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Catatan</h4>
            </div>
            <form id="form_catatan" method="post" action="{{ route('vendor.order.post', [Auth::user()->group->code]) }}" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row">
                        <input type="hidden" name="order_id" id="order_id"/>
                        <input type="hidden" name="status" id="status"/>
                        <div class="col-md-12">
                            <textarea rows="3" class="form-control" id="catatan" name="catatan" type="text"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-danger pull-left" type="button" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-sm btn-primary pull-right" type="button" onclick="checkCatatan()">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="catatan-vendor-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Catatan</h4>
            </div>
            <div class="modal-body" >
                <div class="form-group row">
                    <input type="hidden" name="order_number" id="order_number"/>
                </div>
                <div id="body-catatan">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger pull-left" type="button" data-dismiss="modal">Tutup</button>
                <button class="btn btn-sm btn-primary pull-right" type="button" onclick="checkCatatanVendor()">Kirim</button>
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

    var table_cart = null;
    table_cart =  $('#tabel-cart').DataTable({
        lengthChange: false,
        searching: false, 
        paging:   false,
        ordering: true,
        info:     false
    })

    function checkCatatan() {
        if($("#catatan-modal .modal-content .modal-body #catatan").val() == '') {
            toastr.error('Isi catatan', 'Informasi!')
        } else {
            $("#catatan-modal .modal-content #form_catatan").submit();
        }
    }

    function showModalCatatan(order_id, status) {
        $("#catatan-modal .modal-content .modal-body #catatan").val('');
        $("#catatan-modal .modal-content .modal-body #order_id").val(order_id);
        $("#catatan-modal .modal-content .modal-body #status").val(status);
        $("#catatan-modal").modal('show');
    }

    function checkCatatanVendor() {
        if($("#catatan-vendor-modal .modal-content .modal-body #body-catatan #catatan").val() == '') {
            toastr.error('Isi catatan', 'Informasi!')
        } else {
            $.ajax({
                type:'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url:'{{ route('vendor.order.notes.post', [Auth::user()->group()->first()->code]) }}',
                data:{
                    order_number: $("#catatan-vendor-modal .modal-content .modal-body #order_number").val(),
                    catatan: $("#catatan-vendor-modal .modal-content .modal-body #body-catatan #catatan").val(),
                    type: 'Vendor',
                },
                success:function(response) {
                    toastr.success("Catatan Terkirim");
                    $("#catatan-vendor-modal .modal-content .modal-body #body-catatan").empty()
                    showModalCatatanVendor(response)
                }
            });
        }
    }

    function showModalCatatanVendor(order_number) {
        $.ajax({
            type:'GET',
            url:'{{ route('vendor.order.notes', [Auth::user()->group()->first()->code]) }}',
            data:{
                order_number: order_number
            },
            success:function(response) {
                $("#catatan-vendor-modal .modal-content .modal-body #body-catatan").empty();
                var html = ``;
                if(response.order_notes.length == 0) {
                    html += 
                    `<hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea rows="3" class="form-control" id="catatan" name="catatan" type="text"></textarea>
                        </div>
                    </div>`
                } else {
                    html += 
                    `<div class="window">` 
                    response.order_notes.forEach( data=> {
                        if(data.type == 'Vendor') {
                            html += 
                            `<div class="chats">
                                <span class="u1 chat">`+data.note+`</span>
                            </div>` 
                        } else {
                            html += 
                            `<div class="chats">
                                <span class="u2 chat">`+data.note+`</span>
                            </div>` 
                        }
                    });
                    html += 
                    `</div>` 
                    html += 
                    `<hr>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea rows="2" class="form-control" id="catatan" name="catatan" type="text"></textarea>
                        </div>
                    </div>`
                }
                $("#catatan-vendor-modal .modal-content .modal-body #order_number").val(order_number);
                $("#catatan-vendor-modal .modal-content .modal-body #body-catatan").append(html);
                $("#catatan-vendor-modal").modal('show');
            }
        });
    }
</script>
@endpush