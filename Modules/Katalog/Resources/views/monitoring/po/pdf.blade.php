<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> kunci.io</title>
    <link href="{{ asset('techone/images/pngap2.png') }}" rel="icon">
    <link href="{{ asset('techone/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('techone/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('techone/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/css/magnific-popup.min.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/css/jquery.scrollbar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/css/chosen.min.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/css/ovic-mobile-menu.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/css/customs-css5.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/css/daterangepicker.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
</head>
<body>	
    <div class="main-content shop-page checkout-page">
        <div class="container">
            <div class="breadcrumbs row">
                <div class="col-md-12 pull-right">
                    <img src="{{ asset('techone/images/ap2logo.png') }}" width="200" height="70"/>
                </div>
                <div class="breadcrumbs">
                    <h3>Purchase Order</h3>
                </div>
                <hr>                        
            </div>
                        
            <div style="width:100%;margin-top:-30px;" class="content-form">                            
                <table style="border:none;" class="table col-xs-12" cellspacing="5">
                    <tr class="row" style="border:none;">
                        <?php
                            $vendor = new \App\Vendor\VendorMaster;
                            $vendor_master = $vendor->setConnection('mysql');
                            $group = new \App\Group\group;
                            $group = $group->setConnection('mysql');
                            $vendor_master = $vendor_master->where('vendor_katalog_id', $po->vendor_id)->where('group_id', $group->select('id')->where('code',$po->vendor_from)->first()->id)->first();
                        ?>
                        <td width="40%" style="border:none; vertical-align:top;">
                            <span class="label-text" style="font-size:11px;">Vendor</span><br>
                            <span class="label-text" style="font-size:11px;"><b>{{ $vendor_master->vendor_name }}</b></span><br>                                
                            <span class="label-text" style="font-size:11px;">{{ $vendor_master->vendor_address_master->street }}<br>{{ $vendor_master->vendor_address_master->city }}, {{ $vendor_master->vendor_address_master->region }}</span><br>
                            <table>
                                <tr>
                                    <td width="10%;"><span class="label-text" style="font-size:11px;">Phone : </span></td>                               
                                    <td width="90%;"><span class="label-text" style="font-size:11px;">{{ $vendor_master->vendor_address_master->telephone }}</span></td>
                                </tr>
                                <tr>
                                    <td width="10%;"><span class="label-text" style="font-size:11px;">Fax : </span></td>               
                                    <td width="90%;"><span class="label-text" style="font-size:11px;">{{ $vendor_master->vendor_address_master->fax }}</span></td>
                                </tr>
                                <tr>
                                    <td width="10%;"><span class="label-text" style="font-size:11px;">Email : </span></td>
                                    <td width="90%;"><span class="label-text" style="font-size:11px;">{{ $vendor_master->email }}</span></td>
                                </tr>
                                <tr>
                                    <td width="10%;"><span class="label-text" style="font-size:11px;">NPWP : </span></td>
                                    <td width="90%;"><span class="label-text" style="font-size:11px;">-</span></td>
                                </tr>
                            </table>
                        </td>
                        <?php
                            $customer = new \App\Customer\Customer;
                            $customer = $customer->setConnection('mysql');
                            $customer = $customer->find($po->po_by);
                        ?>
                        <td width="40%" style="border:none; vertical-align:top;">
                            <span class="label-text" style="font-size:11px;">Buyer</span><br>
                            <span class="label-text" style="font-size:11px;"><b>{{ $customer->company }}</b></span><br>                                
                            <span class="label-text" style="font-size:11px;">@if(isset($customer->customer_address)) {{ $customer->customer_address->street }} @else - @endif<br>@if(isset($customer->customer_address)) {{ $customer->customer_address->city }}, {{ $customer->customer_address->region }} @else - @endif</span><br>
                            <table style="font-size:11px;">
                                <tr>
                                    <td width="10%;"><span class="label-text" style="font-size:11px;">Phone : </span></td>                               
                                    <td width="90%;"><span class="label-text" style="font-size:11px;">@if(isset($customer->customer_address)) {{ $customer->customer_address->telephone }} @else - @endif</span></td>
                                </tr>
                                <tr>
                                    <td width="10%;"><span class="label-text" style="font-size:11px;">Fax : </span></td>               
                                    <td width="90%;"><span class="label-text" style="font-size:11px;">@if(isset($customer->customer_address)) {{ $customer->customer_address->fax }} @else - @endif</span></td>
                                </tr>
                                <tr>
                                    <td width="10%;"><span class="label-text" style="font-size:11px;">Email : </span></td>
                                    <td width="90%;"><span class="label-text" style="font-size:11px;">{{ $customer->email }}</span></td>
                                </tr>
                            </table>
                        </td>                                 
                        <td width="20%" style="border:none; vertical-align:top;">
                            <span class="label-text" style="font-size:11px;"><b>PO NO</b></span><br>
                            <span class="label-text" style="font-size:11px;">{{ $po->po_number }}</span><br>
                            <span class="label-text" style="font-size:11px;"><b>Order NO</b></span><br>
                            <span class="label-text" style="font-size:11px;">{{ $po->order_number }}</span><br>
                            <span class="label-text" style="font-size:11px;"><b>PO Date</b></span><br>
                            <span class="label-text" style="font-size:11px;">{{ date('d-M-Y', strtotime($po->po_date)) }}</span><br>
                            <span class="label-text" style="font-size:11px;"><b>NO PR</b></span><br>
                            <span class="label-text" style="font-size:11px;">{{ $po->no_pr }}</span>
                        </td>
                    </tr>
                </table>
                <table class="table table-striped table-bordered col-xs-12">
                    <thead style="background-color:#F9F7F6;color:#555;">
                        <tr class="title" style="font-size:11px;">
                            <th class="text-center" style="vertical-align:middle; font-size:11px;color: #555;">Uraian Pekerjaan</td>
                            <th class="text-center" style="vertical-align:middle; font-size:11px;color: #555;">Vol.</td>
                            <th class="text-center" style="vertical-align:middle; font-size:11px;color: #555;">Sat.</td>
                            <th class="text-center" style="vertical-align:middle; font-size:11px;color: #555;">Harga E-Catalogue Tanpa PPN</td>
                            <th class="text-center" style="vertical-align:middle; font-size:11px;color: #555;">Jumlah Tanpa PPN</td>                                
                            <th class="text-center" style="vertical-align:middle; font-size:11px;color: #555;">Harga Satuan (Final Tanpa PPN)</td>
                            <th class="text-center" style="vertical-align:middle; font-size:11px;color: #555;">Harga Total (Final Tanpa PPN)</td>                                
                        </tr>
                    </thead>
                    <tbody style="font-size:12px;">
                        @foreach ($po->po_detail()->get() as $d)
                        <tr class="each-item">
                            <td style="font-size:11px;text-align:left;vertical-align:middle" id="uraian_barang">{{ $d->uraian_pekerjaan }}</td>
                            <td style="font-size:11px;text-align:center;vertical-align:middle" id="volume_barang">{{ $d->volume }}</td>
                            <td style="font-size:11px;text-align:left;vertical-align:middle" id="satuan_barang">{{ $d->satuan }}</td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="harga_barang">
                                {{ number_format($d->harga_ecatalogue_tanpa_ppn, 0) }}
                            </td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="jumlah_harga_barang">
                                {{ number_format($d->jumlah_tanpa_ppn, 0) }}
                            </td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="harga_satuan_nego_barang">
                                {{ number_format($d->harga_satuan_final_tanpa_ppn, 0) }}
                            </td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="total_nego_barang">
                                {{ number_format($d->harga_total_final_tanpa_ppn, 0) }}
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($po->po_detail_biaya_pengiriman()->get() as $os)
                        <tr class="each-item">
                            <td style="font-size:11px;text-align:left;vertical-align:middle" id="uraian_barang">{{ $os->uraian_pekerjaan }}</td>
                            <td style="font-size:11px;text-align:left;vertical-align:middle" id="volume_barang"></td>
                            <td style="font-size:11px;text-align:left;vertical-align:middle" id="satuan_barang"></td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="harga_barang">
                                {{ number_format($os->harga_ecatalogue_tanpa_ppn, 0) }}
                            </td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="jumlah_harga_barang">
                                {{ number_format($os->jumlah_tanpa_ppn, 0) }}
                            </td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="harga_satuan_nego_barang">
                                {{ number_format($os->harga_satuan_final_tanpa_ppn, 0) }}
                            </td>
                            <td style="font-size:11px;text-align:right;vertical-align:middle" id="total_nego_barang">
                                {{ number_format($os->harga_total_final_tanpa_ppn, 0) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="font-size:12px;">
                        <tr>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="4">
                                Subtotal
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_jumlah_tanpa_ppn->subtotal, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->subtotal, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_total_final_tanpa_ppn->subtotal, 0) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="4">
                                PPN
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_jumlah_tanpa_ppn->ppn, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->ppn, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_total_final_tanpa_ppn->ppn, 0) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="4">
                                Total
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_jumlah_tanpa_ppn->total, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->total, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_total_final_tanpa_ppn->total, 0) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="4">
                                Harga Pembulatan
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_jumlah_tanpa_ppn->harga_pembulatan, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_satuan_final_tanpa_ppn->harga_pembulatan, 0) }}
                            </td>
                            <td style="border-top:none;border-bottom:none;text-align:right;vertical-align:middle;" colspan="1">
                                {{ number_format($po->po_total_harga_total_final_tanpa_ppn->harga_pembulatan, 0) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>      
        </div>
    </div>   
    <script src="{{ asset('techone/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('techone/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('techone/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('techone/js/owl.thumbs.min.js') }}"></script>
    <script src="{{ asset('techone/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('techone/js/ovic-mobile-menu.js') }}"></script>
    <script src="{{ asset('techone/js/mobilemenu.min.js') }}"></script>
    <script src="{{ asset('techone/js/jquery.plugin-countdown.min.js') }}"></script>
    <script src="{{ asset('techone/js/jquery-countdown.min.js') }}"></script>
    <script src="{{ asset('techone/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('techone/js/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('techone/js/chosen.min.js') }}"></script>
    <script src="{{ asset('techone/js/frontend.js') }}"></script>
    <script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
    </script>
</body>
</html>