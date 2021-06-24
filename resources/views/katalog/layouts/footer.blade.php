<footer>
    <div class="footer layout2 layout3">
        <div class="container">
            <div class="main-footer">
                <div class="row auto-clear">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-ts-12">
                        <div class="widget widget-custom-menu">
                            <h3 class="widgettitle">Information</h3>
                            <ul >
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Customer Service</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Site Map</a></li>
                                <li><a href="#">Search Terms</a></li>
                                <li><a href="#">Advanced Search</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-34 col-md-3 col-sm-6 col-xs-6 col-ts-12 ">
                        <div class="widget widget-custom-menu">
                            <h3 class="widgettitle">Why buy from us</h3>
                            <ul >
                                <li><a href="#">Shipping & Returns</a></li>
                                <li><a href="#">Secure Shopping</a></li>
                                <li><a href="#">International Shopping</a></li>
                                <li><a href="#">Affiliates</a></li>
                                <li><a href="#">Group Sales</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-ts-12">
                        <div class="widget widget-custom-menu">
                            <h3 class="widgettitle">My account</h3>
                            <ul >
                                <li><a href="login.html">Sign In</a></li>
                                <li><a href="shopping-cart.html">View Cart</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Helps</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="newsletter-form layout3 box-has-content">
                            <div class="widget widget-newsletter">
                                <h3 class="widgettitle">Contact information</h3>
                                <p class="des"> PT. Inamart Sukses Jaya <br> Contact: <span class="number">(+68) 123 456 7890</span></p>
                                <div class="newsletter-block">
                                    <div class="newsletter-inner">
                                        <input type="text" class="newsletter-info" placeholder="Enter Your e-mail...">
                                    </div>
                                    <a href="#" class="submit">Sign UP</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-note layout2">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 left-content">
                        <div class="coppy-right">
                            <h3 class="content">© Copyright 2019 <span class="site-name"> PT Inamart Sukses Jaya</span></h3>
                        </div>
                        <ul class="list-payment">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- <footer>
    <div class="footer layout1 ">
        <div class="container">
            <div class="main-footer">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-8">
                        <div class="coppy-right">
                            <h3 class="content">© Copyright 2019 <span class="site-name"> PT Inamart Sukses Jaya</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer> --}}


<div class="modal modal-loading fade bd-example-modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1">
	<div class="modal-dialog modal-sm"><center>
		<div class="modal-content" style="width:75px;color:#1d66ad;background-color:white;padding:15px">
			<span class="fa fa-refresh fa-spin fa-3x"></span>
		</div>
	</div>
</div>
<div class="modal fade" id="assign-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail</h4>
            </div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Tutup</button>
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="keranjang-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				{{-- <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Lanjutkan Belanja</button>
				<a class="btn btn-sm btn-danger" href="{{ route('katalog.cart.index', [Auth::user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString('cart')]) }}">Beli</a> --}}
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="perbandingan-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            </div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				{{-- <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Lanjutkan Belanja</button>
				<a class="btn btn-sm btn-danger" href="{{ route('katalog.comparison.index', [Auth::user()->group()->first()->code, Illuminate\Support\Facades\Crypt::encryptString('comparison')]) }}">Lihat</a> --}}
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="detail-checkout-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pemesanan</h4>
            </div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Tutup</button>
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="detail-order-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pemesanan</h4>
            </div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Tutup</button>
				<a class="btn btn-sm btn-danger" onclick="checkout()">Checkout</a>
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="catatan-customer-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <button class="btn btn-sm btn-primary pull-right" type="button" onclick="checkCatatanCustomer()">Kirim</button>
            </div>
        </div>
    </div>
</div>