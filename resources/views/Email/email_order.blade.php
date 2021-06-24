<!DOCTYPE html>
<html>

<head>
    <title>Pemesanan Produk</title>
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
    crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>

<body>
    <div class="">
        <div class="aHl">
        </div>
        <div id=":4ex" tabindex="-1"></div>
        <div id=":4ff" class="ii gt">
            <div id=":4f5" class="a3s aXjCH msg8579308622311969267"><u></u>
                <div bgcolor="#FFFFFF" style="margin:0;padding:0">
                    <table border="0" cellpadding="0" cellspacing="0" height="100%" lang="id" style="min-width:348px" width="100%">
                        <tbody>
                            <tr height="32" style="height:32px">
                                <td></td>
                            </tr>
                            <tr align="center">
                                <td>
                                    <div>
                                        <div></div>
                                    </div>
                                    <table border="0" cellpadding="0" cellspacing="0" style="padding-bottom:20px;max-width:916px;min-width:220px">
                                        <tbody>
                                            <tr>
                                                <td style="width:8px" width="8"></td>
                                                <td>

                                                    <div align="center" class="m_8579308622311969267mdv2rw" style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px">
                                                        <img height="24" src="{{ asset('techone/images/' . $group->style->logo) }}"
                                                            style="width:175px;height:50px;margin-bottom:16px" width="75" class="CToWUd">
                                                        <div style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                                            <div style="font-size:24px">
                                                                PT {{ $group->name }}
                                                            </div>
                                                        </div>
                                                        <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:justify">
                                                            Yth. Bapak/Ibu <b> {{ $vendor->vendor_name }} 
                                                            </b><br>
                                                            {{ count($order->order_detail) }} Produk anda telah dipesan,
                                                        </div>
                                                        <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:justify">
                                                            Berikut detail pemesanan:<br/><br/>
                                                            <h5 class="card-title"><b>Detail Order</b></h5>
                                                            <hr>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="order_number">No Order</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->order_number }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="name">Nama Pekerjaan</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->name }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="no_pr">No PR</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->no_pr }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="vendor_name">Vendor</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->vendor_name }} - Katalog {{ $order->vendor_froms->name }}
                                                                </div>
                                                            </div>
                                                            <h5 class="card-title" style="margin-top:40px;"><b>Detail Pemesan</b></h5>
                                                            <hr>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="first_name">Nama</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->order_address->first_name }} {{ $order->order_address->last_name }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="email">Email</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->order_address->email }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="company">Perusahaan</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->order_address->company }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="address">Alamat</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->order_address->address }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="telephone">No Telepon</label>
                                                                <div class="col-md-4">
                                                                    {{ $order->order_address->phone }}
                                                                </div>
                                                                <label class="col-md-2 col-form-label text-right" for="fax">Fax</label>
                                                                <div class="col-md-4">
                                                                    {{ $order->order_address->fax }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="province">Provinsi</label>
                                                                <div class="col-md-10">
                                                                    {{ $order->order_address->province }}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-2 col-form-label" for="city">Kota</label>
                                                                <div class="col-md-4">
                                                                    {{ $order->order_address->city }}
                                                                </div>
                                                                <label class="col-md-2 col-form-label text-right" for="postcode">Kode Pos</label>
                                                                <div class="col-md-4">
                                                                    {{ $order->order_address->postcode }}
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
                                                                            <th class="text-center" style="vertical-align:middle">Total</th>
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
                                                                            <td class="text-right">{{ number_format($od->price*$od->qty) }}</td>
                                                                            <?php $totalproduk +=  $od->qty * $od->price ?>
                                                                            @if(count($od->order_shipping) != 0)
                                                                            <tr style="border-top:none;">
                                                                                <td style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="4">
                                                                                    <span class="label-text" style="text-align:left; font-weight: bold">Biaya Pengiriman</span>
                                                                                </td>
                                                                            </tr>
                                                                            @foreach($od->order_shipping as $os)
                                                                            <tr style="border-top:none;border-bottom:none;">
                                                                                <td class="product-name" style="border-top:none;border-bottom:none;text-align:left;vertical-align:middle;" align="left" colspan="3">
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
                                                                            <td class="text-right" style="font-weight:bold;vertical-align:middle;" align="left" colspan="4">Grand Total</td>
                                                                            <td class="total text-right" colspan="1">Rp. {{ number_format($totalproduk, 0) }}</td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:justify">
                                                            <b>Catatan :</b> <br/><br/>
                                                            1. Apabila menerima email atau telepon yang mencurigakan, mohon konfirmasi segera ke Unit Pengadaan kunci.io di nomor 021-5505130 atau 021-5505203.<br /><br />
                                                            2. Email terkirim secara otomatis, harap tidak membalas email ini.
                                                        </div>
                                                    </div>
                                                    <div style="text-align:left">
                                                        <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                                            <div>Anda menerima email ini sebagai pemberitahuan penting pada pemesanan dari e-Catalogue PT {{ $group->name }}.</div>
                                                            <div style="direction:ltr">
                                                                © {{ date('Y') }} PT {{ $group->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width:8px" width="8"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr height="32" style="height:32px">
                                <td></td>
                            </tr>
                        </tbody>
                    </table><img height="1" src="https://ci3.googleusercontent.com/proxy/hiljIifYG7Y9iWkCGVVjXNuyxGpOVwDUO7PNV5AVwk0QxJp7e7mqoUWl2TcWq4SKYOEaLZOn_AMTK9IQc77jLpYbEoe15eS28kyI8SxYgbSsoxOpFAOGkrILljDZ6JVOhRWk3jizf2q4ajsZCmCNs1Jyn6jgQHCKS3blv-jiRwNyMf_574UTmh9qY2u5vqhpNxE5oOOt4fe95pKwD8-X93rBlOS3r1e2q6vNaQ-OOV4WW4Vzi-yKHFDaoya61NFWFxwxNhP2mg8fQQ8p_vBTxoljNynDDXbgRVr0ZIjkF4R0UKytlVm2v9ETpj-h6Ih4dYB7DAh8RT60wblODuLutXpoyVptQFhQ0BvrLYo10Ji-v2a1irRCgSmWoE7EOJS4-3i-bEqX2mqjVWnOfchEVzFsHTEAeC2g96k3z5MhKyt1tqc=s0-d-e1-ft#https://notifications.googleapis.com/email/t/AFG8qyXwhD9jLGLDpfD133S-4tuwjE21J5W7gv7QG8xbHgRa4NV6nN4PURFYN-e6C0jKFAcbevCyfFfZXVYAMZpfOWqDlz6PMhAR5QQPVT73FHY0hHAvwLUtyjd08zDlqIpQ4JpZYu2I4VcE_Npd6MBqsJmDccLeS9qD6l00-ic-beBIaOnH8NVYPSRGVRQmWAnFF7T9qSPqQix_VaDdndbP2g-gl3P9IV81T7kkKvZ69C8gEAiW_ZhoK80O/a.gif"
                        width="1" class="CToWUd"></div>
            </div>
            <div class="yj6qo"></div>
            <div class="yj6qo"></div>
            <div class="yj6qo"></div>
        </div>
        <div id=":4et" class="ii gt" style="display:none">
            <div id=":4es" class="a3s aXjCH undefined"></div>
        </div>
        <div class="hi"></div>
    </div>
</body>

</html>