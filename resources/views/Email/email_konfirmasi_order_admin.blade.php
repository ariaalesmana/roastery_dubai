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
                                                            Yth. Bapak/Ibu <b> Administrator
                                                            </b><br>
                                                            Pesanan dengan nomor order <b>{{ $order->order_number }}</b> telah 
                                                            @if($order->status == -1) ditolak @elseif($order->status == 1) dikonfirmasi @endif,
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