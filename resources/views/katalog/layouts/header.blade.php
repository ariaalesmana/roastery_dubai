<header>
    <div class="header layout6">
        <div class="container main-menu-wapper">
            <div class="topbar layout2 box-has-content">
                <div class="header-nav">
                    <div class="header-nav-inner">
                        <div class="box-header-nav">
                            <div class="container-wapper">
                                <a class="menu-bar mobile-navigation" href="#">
                                    <span class="icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                    <span class="text">Main Menu</span>
                                </a>
                                @can('customer')
                                    <ul class="menu-topbar top-links">
                                        <li class="menu-item menu-item-has-children katalog-bersama">
                                            <a class="kt-item-title ovic-menu-item-title">Katalog Bersama</a>
                                            <ul class="sub-menu">
                                                @foreach(get_list_katalog() as $lk)
                                                    <li>
                                                        <a href="{{ route('katalog', [$lk->code]) }}" style="cursor:pointer;">{{ $lk->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children monitoring">
                                            <a class="kt-item-title ovic-menu-item-title"> Monitoring </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="{{ route('katalog.monitoring.order', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('order')]) }}">Order</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('katalog.monitoring.po.index', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('po')]) }}">PO</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children keranjang">
                                            <a class="kt-item-title ovic-menu-item-title"> Keranjang </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="{{ route('katalog.cart.index', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('cart')]) }}">Keranjang Belanja</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('katalog.comparison.index', [Auth::user()->group->code, Illuminate\Support\Facades\Crypt::encryptString('comparison')]) }}">Perbandingan</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="menu-topbar top-links">
                    <li>
                        @if(Auth::user() != null)
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li class="menu-item-has-children">
                                <a href="#" class="toggle-sub-menu"><span class="text">Masuk</a>
                                <ul class="list sub-menu">
                                    <li><a href="{{ route('login.admin') }}" class="text">Admin</a></li>
                                    <li><a href="{{ route('login.vendor') }}" class="text">Vendor</a></li>
                                    <li><a href="{{ route('login.customer') }}" class="text">Customer</a></li>
                                </ul>
                            </li>
                        @endif
                    </li>
                    @if(Auth::user() != null)
                        <li><a>{{ Auth::user()->email }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-header">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12  left-content">
                            <div class="logo">
                                <a><img src="{{ asset('techone/images/' . $style->logo) }}" style="width: 150px;height: 70px;" alt=""></a>
                            </div>
                        </div>	
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 middle-content">
                            <div class="search-form layout1 box-has-content">
                                <div class="search-block">
                                    <div class="search-choice parent-content">
                                        <select data-placeholder="All Categories" class="chosen-select">
                                            <option value="1">All categories</option>
                                        </select>
                                    </div>
                                    <div class="search-inner">
                                        <form class="form-inline" action="{{ url()->current() }}">
                                            <input type="text" class="search-info" placeholder="Cari..." name="keyword">
                                        </form>
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
                                            <span class="total-price"><span class="text">Cart: </span>Rp. 0.00</span>
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
                    </div>	
                </div>
            </div>
        </div>
    </div>
</header>


<!-- <header>
    <div class="header layout2 no-prepend-box-sticky header-home3">
        <div class="topbar layout1">
            <div class="container">
                <ul class="menu-topbar top-links">
                    <li>
                        @if(Auth::user() != null)
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <li class="menu-item-has-children">
                                <a href="#" class="toggle-sub-menu"><span class="text">Masuk</a>
                                <ul class="list sub-menu">
                                    <li><a href="{{ route('login.admin') }}" class="text">Admin</a></li>
                                    <li><a href="{{ route('login.vendor') }}" class="text">Vendor</a></li>
                                    <li><a href="{{ route('login.customer') }}" class="text">Customer</a></li>
                                </ul>
                            </li>
                        @endif
                    </li>
                    <li><a>About</a></li>
                    @if(Auth::user() != null)
                        <li><a>{{ Auth::user()->email }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-header">
            <div class="top-header">
                <div @if(Auth::user() != null) class="this-sticky" @endif> {{-- if digunakan agar dropdown menu bisa berfungsi dengan baik --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6  left-content">
                                <div class="logo">
                                    <a><img src="{{ asset('techone/images/' . $style->logo) }}" alt=""></a>
                                </div>
                            </div>
                            {{-- @can('customer')

                            @include('katalog.layouts.header_menu')

                            @endcan --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav-wapper ">
                <div class="container main-menu-wapper">
                    <div class="row">

                        {{-- @include('katalog.layouts.header_category')

                        @include('katalog.layouts.header_search') --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header> -->
