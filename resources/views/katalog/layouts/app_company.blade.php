<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title> kunci.io</title>
        
	<link href="{{ asset('techone/images/' . $style->small_logo) }}" rel="icon">
	<link href="{{ asset('techone/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('techone/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('techone/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"> 
	<link href="{{ asset('techone/css/animate.min.css') }}" rel="stylesheet">
	<link href="{{ asset('techone/css/magnific-popup.min.css') }}" rel="stylesheet">
	<link href="{{ asset('techone/css/jquery-ui.min.css') }}" rel="stylesheet">
	<link href="{{ asset('techone/css/jquery.scrollbar.min.css') }}" rel="stylesheet">
	<link href="{{ asset('techone/css/chosen.min.css') }}" rel="stylesheet">
	<link href="{{ asset('techone/css/ovic-mobile-menu.css') }}" rel="stylesheet">
	<link href="{{ asset('techone/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('techone/css/customs-css5.css') }}" rel="stylesheet">
    <link href="{{ asset('techone/custom-select/dist/css/select2.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/css/daterangepicker.min.css') }}" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href='https://cdn.rawgit.com/hsnaydd/validetta/v1.0.1/dist/validetta.css' rel='stylesheet'>
    <style>
		.swal-wide {
			width:800px !important;
            padding-left: 16px;
            padding-right: 16px;
		}
		.swal-wide-small {
			width:500px !important;
            padding-left: 16px;
            padding-right: 16px;
		}
    </style>
    @stack('styles')
</head>
<body class="home">
    <div class="dim"></div>
	@include('katalog.layouts.header_company')
	    @yield('content')
    @include('katalog.layouts.footer_company')
    
    <a class="back-to-top" href="#"></a>
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
    <script src="{{ asset('techone/custom-select/dist/js/select2.full.min.js')}}"></script>
	<script src="{{ asset('assets/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/ample/plugins/bower_components/moment/moment.jsjs') }}"></script>
    <script src="{{ asset('assets/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script>
        
        document.documentElement.style.setProperty('--main-bg-color', '{{$style->color}}');
        
        @if(Auth::user() != null)
        $('#boxminicarts').hover(function(){
            $('.dim').fadeIn(50);
        },function(){
            $('.dim').fadeOut(50);
        });
        $('#boxminicart').hover(function(){
            $('.dim').fadeIn(50);
        },function(){
            $('.dim').fadeOut(50);
        });
        $('#notif').hover(function(){
            $('.dim').fadeIn(50);
        },function(){
            $('.dim').fadeOut(50);
        });
        $('.keranjang').hover(function(){
            $('.dim').fadeIn(50);
        },function(){
            $('.dim').fadeOut(50);
        });
        $('.monitoring').hover(function(){
            $('.dim').fadeIn(50);
        },function(){
            $('.dim').fadeOut(50);
        });
        $('.katalog-bersama').hover(function(){
            $('.dim').fadeIn(50);
        },function(){
            $('.dim').fadeOut(50);
        });
        calculatecart();
        function calculatecart() {
            $.ajax({
                type : 'GET',
                url : '{{ route('katalog.' .  Auth::user()->group()->first()->code . '.cart.getdata') }}',
                success:function(response){
                    response=JSON.parse(response);

                    var html = `<div class="minicart" style="z-index:1000;">
                                    <div class="cart-block box-has-content" style="z-index:1000;">
                                        <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.cart.index') }}" class="cart-icon-Header">
                                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                            <span class="count">`+response.datacart.count+`</span>
                                        </a>
                                    </div>
                                    <div class="cart-inner" style="z-index:1000;">
                                        <h5 class="title">`+response.datacart.count+` produk di keranjang Anda</h5>
                                        <ul class="list-item" id="listcart">`;
                    var totalprice = 0;
                    response.datacart.data.forEach( data=> {
                    html+=`					<li class="product-item">`;
                    if(data.image == null) {
                        html += 		        `<a class="thumb">
                                                    <img src="{{ asset('/techone/images/product_placeholder.jpg') }}" alt="" style="height:50px;width:50px; margin-top:15px;">
                                                </a>`;
                    } else {
                        html += 		        `<a class="thumb">
                                                    <img src="` + data.image + `" alt="" style="height:50px;width:50px; margin-top:15px;">
                                                </a>`;
                    }
                    html += 		            `<div class="info">
                                                    <a class="product-name">`+data.name+`</a>
                                                    <div class="product-item-qty">
                                                        <span class="number price">
                                                            <span class="qty">`+(data.qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</span> x 
                                                            <span class="price">Rp.`+(data.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>`;

                            totalprice = totalprice	+ data.price;                            
                    });
                    html+=`				</ul>
                                        <div class="subtotal">
                                            <span class="text">Total : </span>
                                            <span class="total-price" style="color: #e5534c;">Rp. `+(response.datacart.total).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</span>
                                        </div>
                                        <div class="group-button-checkout">
                                            <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.cart.index') }}">Lihat</a>
                                        </div>
                                    </div>
                                </div>`
                    
                    var totalhtml = `<span class="text">Cart: </span>`+totalprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    document.getElementById("boxminicart").innerHTML = html;

                    $('.modal-loading').modal('hide');
                }
            });
        }

        calculatecomparison();
        function calculatecomparison(idusr="1") {
            $.ajax({
                type : 'GET',
                url : '{{ route('katalog.' .  Auth::user()->group()->first()->code . '.comparison.getdata') }}',
                data : {
                    user_id : {{ Auth::user()->id }}
                },
                success:function(response){
                    response = JSON.parse(response);

                    var html = `<div class="minicart" style="z-index:1000;">
                                    <div class="cart-block box-has-content" style="z-index:1000;">
                                        <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.comparison.index') }}" class="cart-icon-Header">
                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                            <span class="count">`+response.count+`</span>
                                        </a>
                                    </div>
                                    <div class="cart-inner" style="z-index:1000;">
                                        <h5 class="title">`+response.count+` produk perbandingan</h5>
                                        <ul class="list-item" id="listcart">`;
                    var totalprice = 0;
                    response.data.forEach( data=> {
                    html+=`					<li class="product-item">`;
                    if(data.image == null) {
                        html += 		        `<a class="thumb">
                                                    <img src="{{ asset('/techone/images/product_placeholder.jpg') }}" alt="" style="height:50px;width:50px; margin-top:15px;">
                                                </a>`;
                    } else {
                        html += 		        `<a class="thumb">
                                                    <img src="` + data.image + `" alt="" style="height:50px;width:50px; margin-top:15px;">
                                                </a>`;
                    }
                    html += 		            `<div class="info">
                                                    <a class="product-name">`+data.name+`</a>
                                                    <div class="product-item-qty">
                                                        <span class="number price">
                                                            <span class="price">Rp.`+(data.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>`;

                            totalprice = totalprice	+ data.price;                            
                    });
                    html+=`				</ul>
                                        <div class="group-button-checkout">
                                            <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.comparison.index') }}">Lihat</a>
                                        </div>
                                    </div>
                                </div>`
                    
                    var totalhtml = `<span class="text">Cart: </span>`+totalprice.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    
                    document.getElementById("boxminicarts").innerHTML = html;

                    $('.modal-loading').modal('hide');
                }
            });
        }

        calculateNotif();
        function calculateNotif() {
            $.ajax({
                type:'GET',
                url:'{{ route('katalog.' .  Auth::user()->group()->first()->code . '.notification.getdata') }}',
                success:function(datas) {
                    datas=JSON.parse(datas);
                    var html = `<div class="minicart" style="z-index:1000;">
                                    <div class="cart-block box-has-content" style="z-index:1000;">
                                        <a style="cursor: pointer;" class="cart-icon-Header">
                                            <i class="fa fa fa-bell" aria-hidden="true"></i>
                                            <span class="count">`+datas.count+`</span>
                                        </a>
                                    </div>
                                    <div class="cart-inner" style="z-index:1000;">
                                        <h5 class="title">`+datas.count+` Notifikasi</h5>
                                        <ul class="list-item" id="listcart">`;
                    datas.data.forEach( data=> {

                    if(data.is_read == 0) {
                        html+=`			       <li class="product-item" style="background-color:#fff;">`;
                    } else {
                        html+=`			       <li class="product-item" style="background-color:#fff;">`;
                    }
                    html+=`			            <a class="thumb">
                                                    <img src="{{ asset('/techone/images/icon/beo.png') }}" alt="" style="height:30px;width:30px;margin-top:16px;">
                                                </a>
                                                <div class="info">
                                                    <a class="product-name">
                                                        <span class="number price">
                                                            <span class="price" style="color:#555;">`+data.title+`</span>
                                                        </span>
                                                    </a>
                                                    <div class="product-item-qty">
                                                        <span class="product-name">
                                                            <span class="product-name">`+data.message+`</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </li>`;
                    });
                    html+=`				</ul>
                                    </div>
                                </div>`

                    document.getElementById("notif").innerHTML = html;
                    $('.modal-loading').modal('hide');
                }
            });
        }

        function addtocart(product_id, code_url, name, image, qty, price, unit, sku, vendor_sku, vendor_id, vendor_name, vendor_email) {
            $('.modal-loading').modal('show');
            $.ajax({
                type : 'GET',
                url : '{{ route('katalog.' .  Auth::user()->group()->first()->code . '.cart.add') }}',
                data : {
                    product_id : product_id,
                    product_from : code_url,
                    name : name,
                    image : image,
                    qty : qty,
                    price : price,
                    unit : unit,
                    sku : sku,
                    vendor_sku : vendor_sku,
                    vendor_id : vendor_id,
                    vendor_name : vendor_name,
                    vendor_email : vendor_email
                },
                success:function(response){	
                    response = JSON.parse(response);
                    console.log(response);
                    calculatecart();
                    showPopUpCart();
                }
            });
        }

        function addtocompare(product_id, code_url, name, image, qty, price, unit, sku, vendor_sku, vendor_id, vendor_name, vendor_email) {
            $('.modal-loading').modal('show');
            $.ajax({
                type : 'GET',
                url : '{{ route('katalog.' .  Auth::user()->group()->first()->code . '.comparison.add') }}',
                data : {
                    product_id : product_id,
                    product_from : code_url,
                    name : name,
                    image : image,
                    price : price,
                    unit : unit,
                    sku : sku,
                    vendor_sku : vendor_sku,
                    vendor_id : vendor_id,
                    vendor_name : vendor_name,
                    vendor_email : vendor_email
                },
                success:function(response){	
                    response = JSON.parse(response);
                    calculatecomparison();
                    showPopUpComparison();
                }
            });
        }

        function showPopUpCart(idusr="1") {
            $.ajax({
                type : 'GET',
                url : '{{ route('katalog.' .  Auth::user()->group()->first()->code . '.cart.getdata') }}',
                success:function(response){
                    response = JSON.parse(response);
                    console.log(response);

                    var htmls = `	<div class="row content-form">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                                            <h5 class="title"><span class="count-item">`+response.datacart.count+`</span> Produk di Keranjang Anda</h5>
                                            <div class="table-responsive">
                                                <table class="shopping-cart-content table table-striped table-scroll small-first-col">
                                                    <thead>
                                                        <tr>
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-thumb"></td>
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Nama Produk</td>
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="price">Harga Satuan</td>
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="quantity-item">Jumlah</td>	
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="total">Sub Total</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="body-half-screen">`;
                    var totalprice = 0;
                    response.datacart.data.forEach( data=> {
                    htmls+=`							
                                                        <tr class="each-item">
                                                            <td style="vertical-align:middle" class="product-thumb">`;
                    if(data.image == null) {
                        htmls += 		                        `<a>
                                                                    <img style="height:70px;width:70px;" src="{{ asset('/techone/images/product_placeholder.jpg') }}" alt="">
                                                                </a>`;
                    } else {
                        htmls += 		                        `<a>
                                                                    <img style="height:70px;width:70px;" src="` + data.image + `" alt="">
                                                                </a>`;
                    }
                    htmls += 		                        `</td>
                                                            <td style="text-align:left;vertical-align:middle" class="product-name">
                                                                <a class="product-name">`+data.name+`</a>
                                                            </td>
                                                            <td style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" style="text-align:right">Rp.`+(data.price * 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</td>
                                                            <td style="vertical-align:middle" class="qty" data-title="Unit Price">`+(data.qty).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</td>
                                                            <td style="text-align:right;vertical-align:middle" class="total" data-title="SubTotal" style="text-align:right">Rp.`+(data.qty * data.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</td>
                                                        </tr>`;

                    totalprice = totalprice	+ data.price;                            
                    });
                    htmls+=`						</tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td style="font-size:14px;color:#555;font-weight:bold;" align="right" colspan="3">Total</td>
                                                            <td class="total" style="text-align:right;" colspan="2">Rp. `+(response.datacart.total).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.cart.index') }}" class="button">Beli</a>
                                            <a onclick="tutupDialog()" class="button">Lanjutkan Belanja</a>
                                        </div>
                                    </div>`;

                    Swal.fire({
                        customClass: 'swal-wide',
                        html: htmls,
                        onOpen: function() {
                        
                        },
                        showCancelButton: false,
                        showConfirmButton: false
                    })

                }
            });
        }

        function showPopUpComparison(idusr="1") {
            $.ajax({
                type : 'GET',
                url : '{{ route('katalog.' .  Auth::user()->group()->first()->code . '.comparison.getdata') }}',
                data : {
                    user_id : {{ Auth::user()->id }}
                },
                success:function(response){
                    response = JSON.parse(response);
                    console.log(response);

                    var htmls = `	<div class="row content-form">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-offset">
                                            <h5 class="title"><span class="count-item">`+response.count+`</span> Produk Perbandingan</h5>
                                            <div class="table-responsive">
                                                <table class="shopping-cart-content table table-striped table-scroll small-first-col">
                                                    <thead>
                                                        <tr>
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-thumb"></td>
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="product-name">Nama Produk</td>
                                                            <th style="color: #555; font-size: 14px; font-weight:bold; vertical-align:middle" class="price">Harga Satuan</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="body-half-screen">`;
                    var totalprice = 0;
                    response.data.forEach( data=> {
                    htmls+=`							
                                                        <tr class="each-item">
                                                            <td style="vertical-align:middle" class="product-thumb">`;
                    if(data.image == null) {
                        htmls += 		                        `<a>
                                                                    <img style="height:70px;width:70px;" src="{{ asset('/techone/images/product_placeholder.jpg') }}" alt="">
                                                                </a>`;
                    } else {
                        htmls += 		                        `<a>
                                                                    <img style="height:70px;width:70px;" src="` + data.image + `" alt="">
                                                                </a>`;
                    }
                    htmls += 		                        `<td style="text-align:left;vertical-align:middle" class="product-name" data-title="Product Name" style="text-align:left">
                                                                <a class="product-name">`+data.name+`</a>
                                                            </td>
                                                            <td style="text-align:right;vertical-align:middle" class="price" data-title="Unit Price" style="text-align:right">Rp.`+(data.price * 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+`</td>
                                                        </tr>`;

                    totalprice = totalprice	+ data.price;                            
                    });
                    htmls+=`						</tbody>
                                                </table>
                                            </div>
                                            <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.comparison.index') }}" class="button">Lihat</a>
                                            <a onclick="tutupDialog()" class="button">Lanjutkan Belanja</a>
                                        </div>
                                    </div>`;

                    Swal.fire({
                        customClass: 'swal-wide',
                        html: htmls,
                        onOpen: function() {
                        
                        },
                        showCancelButton: false,
                        showConfirmButton: false
                    })

                }
            });
        }

        function tutupDialog() {
            swal.close();
        }

        @endif
    </script>
    @stack('scripts')
</body>
</html>