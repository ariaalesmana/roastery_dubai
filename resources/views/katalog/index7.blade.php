<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> TechOne Home 07 - Template</title>
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
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <style>
        .vertical-menu {
            height: auto; !important;
        }

        .kt-popup-quickview {
            width: 40%;
            height: 420px;
            margin: 0 auto;
            background-color: #fff;
            position: relative;
        }
    </style>
</head>
<body class="home">
	<header>
		<div class="header layout6">
			<div class="container main-menu-wapper">
				<div class="topbar layout2 box-has-content">
					<div class="header-nav">
						<div class="header-nav-inner">
							<div class="box-header-nav">
								<div class=" container-wapper">
									<a class="menu-bar mobile-navigation" href="#">
				                        <span class="icon">
				                            <span></span>
				                            <span></span>
				                            <span></span>
				                        </span>
				                        <span class="text">Main Menu</span>
				                    </a>
									<ul id="menu-main-menu" class="main-menu clone-main-menu ovic-clone-mobile-menu box-has-content">
										<li class="menu-item menu-item-has-children">
											<a href="ourblog.html" class="kt-item-title ovic-menu-item-title" title="Blog">CATALOG</a>
											<ul class="sub-menu">
												<li><a href="#">UAE</a></li>
												<li><a href="#">INDONESIA</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<ul class="menu-topbar top-links">
						<li><a href="#">Sign in</a></li>
					</ul>
				</div>
			</div>
			<div class="main-header">
				<div class="top-header">
					<div class="container">
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12  left-content">
								<div class="logo">
									<a href="#"><img src="{{ asset('techone/images/kopi ketjil.png') }}" alt=""></a>
								</div>
							</div>	
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 middle-content">
								<div class="search-form layout1 box-has-content">
									<div class="search-block">
										<div class="search-choice parent-content">
											<select data-placeholder="All Categories" class="chosen-select">
												<option value="1">All categories</option>
												<option value="2">-Electronics</option>
												<option value="3">Acessories</option>
												<option value="4">Table & Accessories</option>
												<option value="5">Headphone</option>
												<option value="6">Batteries & Chargens</option>
												<option value="7">Headphone & Headsets</option>
												<option value="8">Mp3 Player & Acessories</option>
											</select>
										</div>
										<div class="search-inner">
											<input type="text" class="search-info" placeholder="Search...">
										</div>
										<a href="#" class="search-button"><i class="fa fa-search" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>							
							<div class="col-lg-5 col-md-5 col-sm-7 col-xs-12 right-content">
								<ul class="header-control">
									<li class="hotline">
										<div class="icon">
											<i class="fa fa-life-ring" aria-hidden="true"></i>
										</div>
										<div class="content">
											<span class="number"><span class="title">Support</span> (080)123 456 7890</span>
											<span class="text"><span class="title">Email:</span> info@info.com</span>
										</div>
									</li>
									<li class="box-minicart">
										<div class="minicart ">
											<div class="cart-block  box-has-content">
												<a href="shopping-cart.html" class="cart-icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="count">0</span></a>
												<span class="total-price"><span class="text">Cart: </span>$0.00</span>
											</div>
											<div class="cart-inner cart-empty">
												<h5 class="title">You have <span class="count-item">0</span> item(s) in your cart</h5>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="header-nav-wapper">
					<div class="container ">
						<div class=" parent-content">
							<a class="menu-bar mobile-navigation" href="#">
                                    <span class="icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                    <span class="text">Main Menu</span>
                                </a>
                                <a href="#" class="header-top-menu-mobile"><span class="fa fa-cog" aria-hidden="true"></span></a>
							<div class="vertical-content hidden-content layout2">
								<ul class="vertical-menu ovic-clone-mobile-menu">
													<li><a href="#" class="ovic-menu-item-title" title="Cameras"><span class="icon"><img src="{{ asset('techone/images/icon1.png') }}" alt=""></span> Cameras</a></li>
													<li><a href="#" class="ovic-menu-item-title" title="Tv & Audio"><span class="icon"><img src="{{ asset('techone/images/icon2.png') }}" alt=""></span> Tv & Audio</a></li>
													<li class="menu-item-has-children has-megamenu">
														<a href="#" class="ovic-menu-item-title" title="Laptop & Computer"><span class="icon"><img src="{{ asset('techone/images/icon3.png') }}" alt=""></span> Laptop & Computer</a>
														<a href="#" class="toggle-sub-menu"></a>
														<div class="sub-menu sub-menu1 mega-menu">
															<div class="row">
																<div class="widget-custom-menu col-xs-12 col-sm-12 col-md-4">
																	<h5 class="title widgettitle">Electronics</h5>
																	<ul>
																		<li><a href="#">Home Audio & Theater</a></li>
																		<li><a href="#">Camera & Video</a></li>
																		<li><a href="#">Headphone</a></li>
																		<li><a href="#">Video Game</a></li>
																		<li><a href="#">Bluetooth & Wireless</a></li>
																		<li><a href="#">TV & Video</a></li>
																	</ul>
																</div>
																<div class="widget-custom-menu col-xs-12 col-sm-12 col-md-4">
																	<h5 class="title widgettitle">Computers</h5>
																	<ul>
																		<li><a href="#">Computer & Tablet</a></li>
																		<li><a href="#">Monitors</a></li>
																		<li><a href="#">Networking</a></li>
																		<li><a href="#">Drivers</a></li>
																	</ul>
																</div>
																<div class="widget-custom-menu col-xs-12 col-sm-12 col-md-4"></div>
																</div>
															<div class="row">
																<div class="widget-custom-menu col-xs-12 col-sm-12 col-md-4">
																	<h5 class="title widgettitle">Laptops</h5>
																	<ul>
																		<li><a href="#">Software</a></li>
																		<li><a href="#">Camera & Video</a></li>
																		<li><a href="#">Networking</a></li>
																		<li><a href="#">Bluetooth & Wireless</a></li>
																		<li><a href="#">Printer & Ink</a></li>
																	</ul>
																</div>
															</div>
														</div>
													</li>
													<li><a href="#" class="ovic-menu-item-title" title="Accessories"><span class="icon"><img src="{{ asset('techone/images/icon4.png') }}" alt=""></span> Accessories</a></li>
													<li class="menu-item-has-children has-megamenu">
														<a href="#" class="ovic-menu-item-title" title="Smartphone & Table"><span class="icon"><img src="{{ asset('techone/images/icon5.png') }}" alt=""></span> Smartphone & Table</a>
														<a href="#" class="toggle-sub-menu"></a>
														<div class="sub-menu mega-menu sub-menu2">
															<div class="row">
																<div class="widget-custom-menu col-xs-12 col-sm-12 col-md-4 col-lg-4">
																	<h5 class="title widgettitle">Electronics</h5>
																	<ul>
																		<li><a href="#">Home Audio & Theater</a></li>
																		<li><a href="#">Camera & Video</a></li>
																		<li><a href="#">Headphone</a></li>
																		<li><a href="#">Video Game</a></li>
																		<li><a href="#">Bluetooth & Wireless</a></li>
																		<li><a href="#">TV & Video</a></li>
																	</ul>
																</div>
																<div class="widget-custom-menu col-xs-12 col-sm-12 col-md-4 col-lg-4">
																	<h5 class="title widgettitle">Tablets</h5>
																	<ul>
																		<li><a href="#">Home Audio & Theater</a></li>
																		<li><a href="#">Camera & Video</a></li>
																		<li><a href="#">Headphone</a></li>
																		<li><a href="#">Video Game</a></li>
																		<li><a href="#">Bluetooth & Wireless</a></li>
																		<li><a href="#">TV & Video</a></li>
																	</ul>
																</div>
																<div class="widget-custom-menu col-xs-12 col-sm-12 col-md-4 col-lg-4">
																	<h5 class="title widgettitle">Accessories</h5>
																	<ul>
																		<li><a href="#">Home Audio & Theater</a></li>
																		<li><a href="#">Camera & Video</a></li>
																		<li><a href="#">Headphone</a></li>
																		<li><a href="#">Video Game</a></li>
																		<li><a href="#">Bluetooth & Wireless</a></li>
																		<li><a href="#">TV & Video</a></li>
																	</ul>
																</div>
															</div>
														</div>
													</li>
													<li><a href="#" class="ovic-menu-item-title" title="Printers & Ink"><span class="icon"><img src="{{ asset('techone/images/icon6.png') }}" alt=""></span> Printers & Ink</a></li>
													<li class="more-item hidden-item"><a href="#" class="ovic-menu-item-title" title="Game & Consoles"><span class="icon"><img src="{{ asset('techone/images/icon7.png') }}" alt=""></span> Game & Consoles</a></li>
													<li class="more-item hidden-item"> <a href="#" class="ovic-menu-item-title" title="Headphone"><span class="icon"><img src="{{ asset('techone/images/icon8.png') }}" alt=""></span> Headphone</a></li>
												</ul>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="main-content home-page main-content-home7">
		<div class="container">
			<div class="featured-products">
				<div class="section-head box-has-content">
					<h4 class="section-title">UAE Products</h4>
				</div>
				<div class="row auto-clear box-has-content equal-container">
					<div class="product-item layout5 col-lg-4 col-md-6 col-sm-4 col-xs-6 col-ts-12">
						<div class="product-inner equal-elem ">
							<div class="thumb ">
								<a href="#" class="quickview-button"><span class="icon"><i class="fa fa-eye" aria-hidden="true"></i></span> Quick View</a>
								<a href="#" class="thumb-link"><img src="{{ asset('techone/images/kopi.jpeg') }}" alt=""></a>
							</div>
							<div class="info ">
								<div class="inner">
									<div class="rating">
										<ul class="list-star">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
										</ul>
										<span class="count">5 Review(s)</span>
									</div>
									<a href="#" class="product-name">Best Accessories- SteelSeries NIMBUS Controlle</a>
									<div class="price">
										<span class="del">$500.00</span>
										<span class="ins">$250.00</span>
									</div>
									<div class="group-button">
										<div class="inner">
											<a href="#" class="add-to-cart"><span class="text">ADD TO CART</span><span class="icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span></a>
											<a href="#" class="compare-button"><i class="fa fa-exchange" aria-hidden="true"></i></a>
											<a href="#" class="wishlist-button"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="product-item layout5 col-lg-4 col-md-6 col-sm-4 col-xs-6 col-ts-12">
						<div class="product-inner equal-elem ">
							<div class="thumb ">
								<a href="#" class="quickview-button"><span class="icon"><i class="fa fa-eye" aria-hidden="true"></i></span> Quick View</a>
								<a href="#" class="thumb-link"><img src="{{ asset('techone/images/kopi.jpeg') }}" alt=""></a>
							</div>
							<div class="info ">
								<div class="inner">
									<div class="rating">
										<ul class="list-star">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
										</ul>
										<span class="count">5 Review(s)</span>
									</div>
									<a href="#" class="product-name">Rubberized Hard Case Older MacBook Pro 13.3"</a>
									<div class="price">
										<span>$350.00</span>
									</div>
									<div class="group-button">
										<div class="inner">
											<a href="#" class="add-to-cart"><span class="text">ADD TO CART</span><span class="icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span></a>
											<a href="#" class="compare-button"><i class="fa fa-exchange" aria-hidden="true"></i></a>
											<a href="#" class="wishlist-button"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
					<div class="product-item layout5 col-lg-4 col-md-6 col-sm-4 col-xs-6 col-ts-12">
						<div class="product-inner equal-elem ">
							<div class="thumb ">
								<a href="#" class="quickview-button"><span class="icon"><i class="fa fa-eye" aria-hidden="true"></i></span> Quick View</a>
								<a href="#" class="thumb-link"><img src="{{ asset('techone/images/kopi.jpeg') }}" alt=""></a>
							</div>
							<div class="info ">
								<div class="inner">
									<div class="rating">
										<ul class="list-star">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
										</ul>
										<span class="count">5 Review(s)</span>
									</div>
									<a href="#" class="product-name">Smartphone RAM 4 GB New</a>
									<div class="price">
										<span>$350.00</span>
									</div>
									<div class="group-button">
										<div class="inner">
											<a href="#" class="add-to-cart"><span class="text">ADD TO CART</span><span class="icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span></a>
											<a href="#" class="compare-button"><i class="fa fa-exchange" aria-hidden="true"></i></a>
											<a href="#" class="wishlist-button"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="loadmore-products">
				<a href="#" class="button"><i class="fa fa-plus" aria-hidden="true"></i> Load more Products</a>
			</div>
		</div>
	</div>
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
									<p class="des"> 218 Fifth Avenue, HeavenTower NewYork City <br> Phone: <span class="number">(+68) 123 456 7890</span></p>
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
								<h3 class="content">© Copyright 2018 <span class="site-name"> TechOne</span> <span class="text"> Multipurpose PSD. </span>All rights reserved</h3>
							</div>
							<ul class="list-socials">
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 right-content">
							<ul class="list-payment">
								<li><a href="#"><img src="{{ asset('techone/images/payment1.png') }}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('techone/images/payment2.png') }}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('techone/images/payment3.png') }}" alt=""></a></li>
								<li><a href="#"><img src="{{ asset('techone/images/payment4.png') }}" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<a class="back-to-top" href="#"></a>
	<script src="{{ asset('techone/js/jquery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('techone/js/bootstrap.min.js') }}"></script>
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
    <script>
        jQuery(document).ready(function ($) {
        "use strict";

        //menu onepage
        $(".each-section .next-section").on("click", function (e) {
            var url = $(this).attr("href");
            var target = $(url).offset().top;
            $('html,body').animate({scrollTop: target}, 'slow');
            return false;
        });


        function kt_tab_effect() {
            // effect click
            $(document).on('click', '.kt-tab a[data-toggle="pill"]', function () {
                var item = '.product-item';
                var tab_id = $(this).attr('href');
                var tab_animated = $(this).data('animated');
                tab_animated = ( tab_animated == undefined ) ? 'fadeInUp' : tab_animated;

                if ( $(tab_id).find('.owl-carousel').length > 0 ) {
                    item = '.owl-item.active';
                }
                $(tab_id).find(item).each(function (i) {
                    var t = $(this);
                    var style = $(this).attr("style");
                    style = ( style == undefined ) ? '' : style;
                    var delay = i * 200;
                    t.attr("style", style +
                        ";-webkit-animation-delay:" + delay + "ms;"
                        + "-moz-animation-delay:" + delay + "ms;"
                        + "-o-animation-delay:" + delay + "ms;"
                        + "animation-delay:" + delay + "ms;"
                    ).addClass(tab_animated + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                        t.removeClass(tab_animated + ' animated');
                        t.attr("style", style);
                    });
                })
            })
        }

        function kt_get_scrollbar_width() {
            var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
                $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
                inner = $inner[ 0 ],
                outer = $outer[ 0 ];
            jQuery('body').append(outer);
            var width1 = parseFloat(inner.offsetWidth);
            $outer.css('overflow', 'scroll');
            var width2 = parseFloat(outer.clientWidth);
            $outer.remove();
            return (width1 - width2);
        }

        function kt_resizeMegamenu() {
            var window_size = parseFloat(jQuery('body').innerWidth());
            window_size += kt_get_scrollbar_width();
            if ( window_size > 1024 ) {
                if ( $('.container-wapper .main-menu').length > 0 ) {
                    var container = $('.main-menu-wapper');
                    if ( container != 'undefined' ) {
                        var container_width = 0;
                        container_width = parseFloat(container.innerWidth());
                        var container_offset = 0;
                        container_offset = container.offset();
                        setTimeout(function () {
                            $('.main-menu .menu-item-has-children').each(function (index, element) {
                                $(element).children('.mega-menu').css({'width': container_width + 'px'});
                                var sub_menu_width = parseFloat($(element).children('.mega-menu').outerWidth());
                                var item_width = parseFloat($(element).outerWidth());
                                $(element).children('.mega-menu').css({'left': '-' + (sub_menu_width / 2 - item_width / 2) + 'px'});
                                var container_left = container_offset.left;
                                var container_right = (container_left + container_width);
                                var item_left = $(element).offset().left;
                                var overflow_left = (sub_menu_width / 2 > (item_left - container_left));
                                var overflow_right = ((sub_menu_width / 2 + item_left) > container_right);
                                if ( overflow_left ) {
                                    var left = (item_left - container_left);
                                    $(element).children('.mega-menu').css({'left': -left + 'px'});
                                }
                                if ( overflow_right && !overflow_left ) {
                                    var left = (item_left - container_left);
                                    left = left - ( container_width - sub_menu_width );
                                    $(element).children('.mega-menu').css({'left': -left + 'px'});
                                }
                            })
                        }, 100);
                    }
                }
            }
        }

        // function sticky_menu() {
        //     if ( !$('.header').hasClass('no-sticky') ) {
        //         if ( !$('.header').hasClass('no-prepend-box-sticky') ) {
        //             if ( !$('.header .box-sticky').length ) {
        //                 $('.header').prepend('<div class="box-sticky"><div class="container"><div class="row"><div class="col-md-2 col-lg-2"><div class="logo-prepend"></div></div><div class="col-md-9 col-lg-8"><div class="main-menu-prepend"></div></div><div class="col-md-1 col-lg-2"><div class="top-links-prepend"><div class="wishlist-prepend prepend-icon"></div><div class="cart-prepend prepend-icon"></div></div></div></div></div></div>');
        //             }
        //         }
        //         $('.header').find('.logo').clone().appendTo('.header .logo-prepend');
        //         $('.header').find('.main-menu').clone().appendTo('.header .main-menu-prepend').removeClass('clone-main-menu ovic-clone-mobile-menu');
        //         $('.header').find('.wishlist-icon').clone().appendTo('.header .top-links-prepend .wishlist-prepend');
        //         $('.header').find('.box-minicart').clone().appendTo('.header .top-links-prepend .cart-prepend');
        //     }
        // }

        function sticky_menu_run() {
            if ( !$('.header').hasClass('no-sticky') ) {
                if ( $(window).width() > 1024 ) {
                    if ( $(window).scrollTop() > 50 ) {
                        $('.header .box-sticky').css({
                            position: 'fixed',
                        });
                        $('.header .box-sticky').addClass('is-sticky');
                        $('.header .this-sticky').addClass('box-sticky');
                    } else {
                        $('.header .box-sticky').css({
                            position: 'relative',
                        });
                        $('.header .box-sticky').removeClass('is-sticky');
                        $('.header .this-sticky').removeClass('box-sticky');
                        $('.header .this-sticky').find('.vertical-content').removeClass('show-in-sticky');
                        $('.header .this-sticky').find('.vertical-content').removeClass('show-up');
                    }
                }
            }
        }

        function kt_innit_carousel() {
            //owl has thumbs 
            $('.owl-carousel.has-thumbs').owlCarousel({
                loop: true,
                items: 1,
                thumbs: true,
                thumbImage: true,
                thumbContainerClass: 'owl-thumbs',
                thumbItemClass: 'owl-thumb-item'
            });
            // owl config
            $(".owl-carousel").each(function (index, el) {
                var config = $(this).data();
                config.navText = [ '<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>' ];
                var animateOut = $(this).data('animateout');
                var animateIn = $(this).data('animatein');
                var slidespeed = parseFloat($(this).data('slidespeed'));

                if ( typeof animateOut != 'undefined' ) {
                    config.animateOut = animateOut;
                }
                if ( typeof animateIn != 'undefined' ) {
                    config.animateIn = animateIn;
                }
                if ( typeof (slidespeed) != 'undefined' ) {
                    config.smartSpeed = slidespeed;
                }

                if ( $('body').hasClass('rtl') ) {
                    config.rtl = true;
                }

                var owl = $(this);
                owl.on('initialized.owl.carousel', function (event) {
                    var total_active = parseInt(owl.find('.owl-item.active').length,10);
                    var i = 0;
                    owl.find('.owl-item').removeClass('item-first item-last');
                    setTimeout(function () {
                        owl.find('.owl-item.active').each(function () {
                            i++;
                            if ( i == 1 ) {
                                $(this).addClass('item-first');
                            }
                            if ( i == total_active ) {
                                $(this).addClass('item-last');
                            }
                        });
                    }, 100);
                })
                owl.on('refreshed.owl.carousel', function (event) {
                    var total_active = parseInt(owl.find('.owl-item.active').length,10);
                    var i = 0;
                    owl.find('.owl-item').removeClass('item-first item-last');
                    setTimeout(function () {
                        owl.find('.owl-item.active').each(function () {
                            i++;
                            if ( i == 1 ) {
                                $(this).addClass('item-first');
                            }
                            if ( i == total_active ) {
                                $(this).addClass('item-last');
                            }
                        });

                    }, 100);
                })
                owl.on('change.owl.carousel', function (event) {
                    var total_active = parseInt(owl.find('.owl-item.active').length,10);
                    var i = 0;
                    owl.find('.owl-item').removeClass('item-first item-last');
                    setTimeout(function () {
                        owl.find('.owl-item.active').each(function () {
                            i++;
                            if ( i == 1 ) {
                                $(this).addClass('item-first');
                            }
                            if ( i == total_active ) {
                                $(this).addClass('item-last');
                            }
                        });

                    }, 100);
                    owl.addClass('owl-changed');
                    setTimeout(function () {
                        owl.removeClass('owl-changed');
                    }, config.smartSpeed)
                })
                owl.on('drag.owl.carousel', function (event) {
                    owl.addClass('owl-changed');
                    setTimeout(function () {
                        owl.removeClass('owl-changed');
                    }, config.smartSpeed)
                })
                owl.owlCarousel(config);
                // Sections backgrounds
                if ( $(window).width() < 992 ) {
                    var itembackground = $(".item-background");
                    itembackground.each(function (index) {
                        if ( $('.item-background').attr("data-background") ) {
                            $(this).css("background-image", "url(" + $(this).data("background") + ")");
                            $(this).css("height", $(this).closest('.owl-carousel').data("height") + 'px');
                            $('.slide-img').css("display", 'none');
                        }
                    });
                }
            });
        }

        function better_equal_elems() {
            if ( $(window).width() + kt_get_scrollbar_width() > 0 ) {
                $('.equal-container').each(function () {
                    var $this = $(this);
                    if ( $this.find('.equal-elem').length ) {
                        $this.find('.equal-elem').css({
                            'height': 'auto'
                        });
                        var elem_height = 0;
                        $this.find('.equal-elem').each(function () {
                            var this_elem_h = 0;
                            this_elem_h = parseFloat($(this).height());
                            if ( elem_height < this_elem_h ) {
                                elem_height = this_elem_h;
                            }
                        });
                        $this.find('.equal-elem').height(elem_height);
                    }
                });
                if ( $(window).width() > 991 ) {
                    $('.equal-container2').each(function () {
                        var $this = $(this);
                        if ( $this.find('.equal-elem2').length ) {
                            $this.find('.equal-elem2').css({
                                'height': 'auto'
                            });
                            var elem_height = 0;
                            $this.find('.equal-elem2').each(function () {
                                var this_elem_h = 0;
                                this_elem_h = parseFloat($(this).height());
                                if ( elem_height < this_elem_h ) {
                                    elem_height = this_elem_h;
                                }
                            });
                            $this.find('.equal-elem2').height(elem_height);
                        }
                    });
                }
            }
        }

        function kt_verticalMegamenu() {
            var window_size = parseFloat(jQuery('body').innerWidth());
            window_size += kt_get_scrollbar_width();
            if ( window_size > 991 ) {
                if ( parseFloat($('.vertical-menu').length) > 0 ) {
                    var container = $('.container-vertical-wapper');
                    if ( container != 'undefined' ) {
                        var container_width = 0;
                        container_width = parseFloat(container.innerWidth());
                        var container_offset = 0;
                        container_offset = container.offset();
                        var content_width = 0;
                        content_width = parseFloat($('.vertical-wapper ').outerWidth());
                        setTimeout(function () {
                            $('.vertical-menu .menu-item-has-children').each(function (index, element) {
                                $(element).children('.mega-menu').css({'width': container_width + 'px'});
                            })
                        }, 100);
                    }
                }

            }
        }

        function hover_product_item() {
            var _winw = $(window).innerWidth();
            if ( _winw > 1024 ) {
                $('.owl-carousel .product-item').hover(
                    function () {
                        $(this).closest('.owl-stage-outer').css({
                            'padding': '0 5px 200px',
                            'margin': '0 -5px -200px',
                        });
                        $(this).closest('.owl-carousel').addClass('owl-hover');
                    }, function () {
                        $(this).closest('.owl-stage-outer').css({
                            'padding': '0',
                            'margin': '0',
                        });
                        $(this).closest('.owl-carousel').removeClass('owl-hover');
                    }
                );

                
            }
        }

        function kt_countdown() {
            if ( $('.kt-countdown').length > 0 ) {
                var labels = [ 'Years', 'Months', 'Weeks', 'Days', 'Hrs', 'Mins', 'Secs' ];
                var layout = '<span class="box-count day"><ul><li class="number">{dnn}</li> <li class="text">Days</li></ul></span><span class="box-count hrs"><ul><li class="number">{hnn}</li> <li class="text">hrs</li></ul></span><span class="box-count min"><ul><li class="number">{mnn}</li> <li class="text">Mins</li></ul></span><span class="box-count secs"><ul><li class="number">{snn}</li> <li class="text">Secs</li></ul></span>';
                $('.kt-countdown').each(function () {
                    var austDay = new Date($(this).data('y'), $(this).data('m') - 1, $(this).data('d'), $(this).data('h'), $(this).data('i'), $(this).data('s'));
                    $(this).countdown({
                        until: austDay,
                        labels: labels,
                        layout: layout
                    });
                });
            }
        };

        function slider_range_price() {
            // Price filter
            $('.slider-range-price').each(function () {
                var min = parseFloat($(this).data('min'));
                var max = parseFloat($(this).data('max'));
                var unit = $(this).data('unit');
                var value_min = parseFloat($(this).data('value-min'));
                var value_max = parseFloat($(this).data('value-max'));
                var label_reasult = $(this).data('label-reasult');
                var t = $(this);
                $('.price-filter').slider({
                    range: true,
                    min: min,
                    max: max,
                    values: [ value_min, value_max ],
                    slide: function (event, ui) {
                        var result = '<span class="from">' + unit + ui.values[ 0 ] + ' </span><span class="to"> ' + unit + ui.values[ 1 ] + '</span>';
                        t.closest('.price-filter').find('.amount-range-price').html(result);
                    }
                });
            });
        }

        function Woocommerce_quantity(argument) {
            //Woocommerce plus and minius
            $(document).on('click', '.quantity .plus, .quantity .minus', function (e) {
                // Get values
                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');
                // Format values
                if ( !currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
                if ( max === '' || max === 'NaN' ) max = '';
                if ( min === '' || min === 'NaN' ) min = 0;
                if ( step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN' ) step = 1;
                // Change the value
                if ( $(this).is('.plus') ) {
                    if ( max && ( max == currentVal || currentVal > max ) ) {
                        $qty.val(max);
                    } else {
                        $qty.val(currentVal + parseFloat(step));
                    }
                } else {
                    if ( min && ( min == currentVal || currentVal < min ) ) {
                        $qty.val(min);
                    } else if ( currentVal > 0 ) {
                        $qty.val(currentVal - parseFloat(step));
                    }
                }
                // Trigger change event
                $qty.trigger('change');
                e.preventDefault();
            });
        }

        /*function newletter_popup() {
            var window_size = parseFloat(jQuery('body').innerWidth());
            window_size += kt_get_scrollbar_width();
            if ( window_size > 767 ) {
                if ( $('body').hasClass('home') ) {
                    $.magnificPopup.open({
                        items: {
                            src: '<div class="kt-popup-newsletter "><div class="popup-content"><h4 class="sub-title">Sign up <br> our <span>newsletter</span><br>And get</h4><h5 class="title">25 <span>%</span> Off</h5><h5 class="small-title">first purchase On all online store items.</h5><div class="input-block inner-content"><div class="input-inner"><input type="text" class="input-info" placeholder="Enter your email" name="input-info"><button class="submit">Subscribe</a></div></div><div class="dontshow"><input type="checkbox" class="checkbox" id="check-email"><label for="check-email" class="text-label">Donâ€™t show this popup again</span></div></div></div></div>',
                            type: 'inline'
                        }
                    });
                }
            }
        }*/

        function quickview_popup() {
            var window_size = parseFloat(jQuery('body').innerWidth());
            window_size += kt_get_scrollbar_width();
            if ( window_size > 768 ) {
                $(document).on('click', '.quickview-button', function () {
                    $.magnificPopup.open({
                        items: {
                            src: '<div class="kt-popup-quickview ">'+
                                    '<div class="details-thumb col-xs-6 col-sm-6">'+
                                        '<div class="owl-carousel nav-style4 has-thumbs" data-autoplay="false" data-nav="true" data-dots="false" data-loop="false" data-slidespeed="800">'+
                                            '<div class="details-item">'+
                                                '<img src="{{ asset('techone/images/kopi.jpeg') }}" alt="">'+
                                            '</div>'+
                                            '<div class="details-item">'+
                                            '<img src="{{ asset('techone/images/kopi.jpeg') }}" alt="">'+
                                        '</div>'+
                                        '<div class="details-item">'+
                                            '<img src="{{ asset('techone/images/kopi.jpeg') }}" alt="">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="details-info col-xs-6 col-sm-6">'+
                                    '<a href="#" class="product-name">Coffee Beans</a>'+
                                    '<div class="rating">'+
                                        '<ul class="list-star">'+
                                            '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>'+
                                            '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>'+
                                            '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>'+
                                            '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>'+
                                            '<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>'+
                                        '</ul>'+
                                        '<span class="count">5 Review(s)</span>'+
                                    '</div>'+
                                    '<p class="description">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 making it over 2000 years old. Richard McClintock, a Latin at Hampden-Sydney College in Virginia.</p>'+
                                    '<div class="price"><span >$450.00</span></div>'+
                                    '<div class="availability">Availability: <a href="#">in Stock</a></div>'+
                                    '<div class="group-button">'+
                                        '<div class="inner">'+
                                            '<a href="#" class="add-to-cart">'+
                                                '<span class="text">ADD TO CART</span>'+
                                                '<span class="icon"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>'+
                                            '</a>'+
                                            '<a href="#" class="compare-button">'+
                                                '<i class="fa fa-exchange" aria-hidden="true"></i>'+
                                            '</a>'+
                                            '<a href="#" class="wishlist-button">'+
                                                '<i class="fa fa-heart-o" aria-hidden="true"></i>'+
                                            '</a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>',
                            type: 'inline'
                        }
                    });
                    kt_innit_carousel();
                    return false;
                });
            }
        }
        function mobile_config() {
            $('.header').prepend('<div class="header-mobile"><div class="container"><div class="logo"></div><div class="box-minicart"></div><a href="#" class="header-top-menu-mobile"><span class="fa fa-cog" aria-hidden="true"></span></a><a class="menu-bar menu-toggle" href="#"><span class="icon"><span></span><span></span><span></span></span><span class="text">Menu</span></a><div class="mobile-config"><a href="#" class="close-btn">x</a><div class="topbar"></div></div></div></div>');
            $('.header').find('.search-form').clone().appendTo('.mobile-config');
            $('.header').find('.topbar .menu-topbar').clone().appendTo('.mobile-config .topbar');
            $('.header').find('.topbar .list-socials').clone().appendTo('.mobile-config .topbar');
            $('.header').find('.main-header .logo > a').clone().appendTo('.header-mobile .logo');
            $('.header').find('.main-header .box-minicart .minicart ').clone().appendTo('.header-mobile .box-minicart');
        }

        function click_function() {
            $(document).on('click', '.changed-button', function () {
                var thisItem = $(this).closest('.changed-item');
                var thisGroup = $(this).closest('.group-changed');
                thisGroup.find('.des-changed').hide();
                thisItem.find('.des-changed').show();
                thisGroup.find('.changed-button').removeClass('active');
                thisItem.find('.changed-button').addClass('active');
                return false;
            });
            $(document).on('click', ' .toggle-sub-menu', function () {
                $(this).closest('.menu-item-has-children').toggleClass('show-sub-menu');
                return false;
            });
            $(document).on('click', '.back-to-top', function () {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });
            $(document).on('click', '.show-content', function () {
                $(this).closest('.parent-content').toggleClass('active');
                $(this).closest('.parent-content').find('.hidden-content').toggleClass('show-up');
                return false;
            });

            $(document).on('click', '.is-sticky .show-content', function () {
                $(this).closest('.parent-content').toggleClass('active');
                $(this).closest('.parent-content').find('.hidden-content').toggleClass('show-in-sticky');
                return false;
            });

            $(document).on('click', '.grid-button', function () {
                $('.grid-button').addClass('active');
                $('.grid-button').closest('.categories-content').find('.list-button').removeClass('active');
                $('.grid-button').closest('.categories-content').find('.product-container').removeClass('list-style');
                $('.grid-button').closest('.categories-content').find('.product-container').addClass('grid-style');
                return false;
            });
            $(document).on('click', '.grid-button', function () {
                better_equal_elems();
                return false;
            });
            $(document).on('click', '.list-button', function () {
                $('.list-button').addClass('active');
                $('.list-button').closest('.categories-content').find('.grid-button').removeClass('active');
                $('.list-button').closest('.categories-content').find('.product-container').removeClass('grid-style');
                $('.list-button').closest('.categories-content').find('.product-container').addClass('list-style');
                return false;
            });
            $(document).on('click', '.view-all-categori .button', function () {
                $(this).toggleClass('active')
                $('.view-all-categori .button').closest('.vertical-content').find('.hidden-item').toggleClass('show-more');
                return false;
            });

            $(document).on('click', '.header-top-menu-mobile', function () {
                $(this).toggleClass('active')
                $('.header').find('.mobile-config').toggleClass('open');
                return false;
            });
            $(document).on('click', '.mobile-config .close-btn', function () {
                $(this).closest('.header-mobile').find('.mobile-config').removeClass('open');
                $(this).closest('.header-mobile').find('.header-top-menu-mobile').removeClass('active');
                return false;
            });


            var window_size = parseFloat(jQuery('body').innerWidth());
            window_size += kt_get_scrollbar_width();
            if ( window_size < 992  && window_size > 479) { 
                $(document).on('click', '.cart-block .cart-icon', function () {
                    $(this).toggleClass('active')
                    $(this).closest('.box-minicart').find('.cart-inner').toggleClass('open');
                    return false;
                });
            }
            

            $(document).on('click', function (e) {
                var target = $(e.target);
                if (!target.closest('.header .mobile-config').length  ) {
                    $('.header-top-menu-mobile').removeClass('active');
                    $('.header .mobile-config').removeClass('open');
                }
            });

            $(document).on('click', function (e) {
                var target = $(e.target);
                if (!target.closest('.parent-content .hidden-content').length  ) {
                    $('.parent-content').removeClass('active');
                    $('.parent-content .hidden-content').removeClass('show-up');
                }
            });
            
            $(document).on('click', function (e) {
                var target = $(e.target);
                if (!target.closest('.box-minicart .cart-inner').length  ) {
                    $('.cart-block .cart-icon').removeClass('active');
                    $('.box-minicart .cart-inner').removeClass('open');
                }
            });
        }

        $(".chosen-select").chosen({disable_search_threshold: 10});
        kt_countdown();
        kt_tab_effect();
        kt_resizeMegamenu();
        kt_verticalMegamenu();
        // sticky_menu();
        mobile_config();
        kt_innit_carousel();
        better_equal_elems();
        quickview_popup();
        hover_product_item();
        click_function();
        slider_range_price();
        Woocommerce_quantity();

        $(window).scroll(function () {
            sticky_menu_run();
            if ( $(this).scrollTop() > 300 ) {
                $('.back-to-top').fadeIn();
                $('.back-to-top').addClass('show');
            } else {
                $('.back-to-top').fadeOut();
                $('.back-to-top').removeClass('show');
            }
        });

        $(window).resize(function () {
            kt_resizeMegamenu();
            kt_verticalMegamenu();
            kt_innit_carousel();
            better_equal_elems();
            quickview_popup();
            hover_product_item();
        });
        $(window).load(function () {
            //newletter_popup()
            better_equal_elems();
            kt_innit_carousel();
            quickview_popup();
            hover_product_item();

        });
        window.onresize = function (event) {
            kt_innit_carousel();
            better_equal_elems();
        };
    });
    </script>
</body>
</html>