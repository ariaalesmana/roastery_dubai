<header>
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
                            <a href="{{ route('login.customer') }}">Masuk</a>
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
                <div class="this-sticky">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6  left-content">
                                <div class="logo">
                                    <a><img src="{{ asset('techone/images/' . $style->logo) }}" alt=""></a>
                                </div>
                            </div>
                            @can('customer')
                            <div class="col-lg-7 col-md-3 col-sm-3 col-xs-5 midle-content">
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
                                                <a href="#" class="header-top-menu-mobile"><span class="fa fa-cog" aria-hidden="true"></span></a>
                                                <ul id="menu-main-menu" class="main-menu clone-main-menu ovic-clone-mobile-menu box-has-content">
                                                    <li class="menu-item menu-item-has-children katalog-bersama">
                                                        <a class="kt-item-title ovic-menu-item-title">Katalog Bersama</a>
                                                        <ul class="sub-menu">
                                                            @foreach(get_list_katalog() as $lk)
                                                            <li>
                                                                <a href="{{ route('company.index', [$lk->module]) }}" style="cursor:pointer;">{{ $lk->name }}</a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li class="menu-item menu-item-has-children">
                                                        <a href="#" class="kt-item-title ovic-menu-item-title monitoring"> Monitoring </a>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="{{ route('katalog.' . Auth::user()->group()->first()->code . '.monitoring.order') }}">Order</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('katalog.' . Auth::user()->group()->first()->code . '.monitoring.po.index') }}">PO</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    {{-- <li class="menu-">
                                                        <a class="kt-item-title ovic-menu-item-title">Vendor</a>
                                                    </li> --}}
                                                    <li class="menu-item menu-item-has-children keranjang">
                                                        <a href="#" class="kt-item-title ovic-menu-item-title"> Keranjang </a>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.cart.index') }}">Keranjang Belanja</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.comparison.index') }}">Perbandingan</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('katalog.' .  Auth::user()->group()->first()->code . '.checkout.index') }}">Checkout</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>								
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-7 right-content" style="margin-top:10px;">
                                <ul class="header-control">
                                    <li class="box-minicart" id="boxminicarts"></li>
                                    <li class="box-minicart" id="boxminicart"></li>
                                    <li class="box-minicart" id="notif"></li>
                                </ul>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav-wapper ">
                <div class="container main-menu-wapper">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-12 left-content">
                            <div class="vertical-wapper parent-content">
                                <div class="block-title show-content">
                                    <span class="icon-bar">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                    <span  class="text">Kategori</span>
                                </div>
                                <a class="menu-bar mobile-navigation " href="#">
                                    <span class="icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </span>
                                </a>
                                <a href="#" class="header-top-menu-mobile"><span class="fa fa-cog" aria-hidden="true"></span></a>
                                <div class="vertical-content hidden-content">
                                    <ul class="vertical-menu ovic-clone-mobile-menu">
                                        @foreach ($category as $cat)
                                            <li class="menu-item-has-children has-megamenu">
                                                <a 
                                                    @can('customer')
                                                    href="{{ route('company.get_category',['module' => $modules, 'category_name' => str_replace(' ', '-', $cat['name']), 'id' => $cat['id']]) }}" 
                                                    @endcan
                                                    class="ovic-menu-item-title">
                                                    {{ $cat['name'] }}
                                                </a>
                                                <a href="#" class="toggle-sub-menu"></a>
                                                <div class="sub-menu sub-menu1 mega-menu">
                                                    <div class="row">
                                                        @foreach ($cat['sub_category'] as $sub_cat)
                                                            <div class="widget-custom-menu col-md-6">
                                                                <a 
                                                                    @can('customer')
                                                                    href="{{ route('company.get_sub_category',['module' => $modules, 'sub_category_name' => str_replace(' ', '-', $sub_cat['name']), 'id' => $sub_cat['id']]) }}" 
                                                                    @endcan>
                                                                    <h5 class="title widgettitle">{{ $sub_cat['name'] }}</h5>
                                                                </a>
                                                                <ul>
                                                                    @foreach ($sub_cat['sub_sub_category'] as $sub_sub_cat)
                                                                        <li>
                                                                            <a 
                                                                                @can('customer')
                                                                                href="{{ route('company.get_sub_sub_category',['module' => $modules, 'sub_sub_category_name' => str_replace(' ', '-', $sub_sub_cat['name']), 'id' => $sub_sub_cat['id']]) }}" 
                                                                                @endcan>
                                                                                {{ $sub_sub_cat['name'] }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="view-all-categori">
                                        <a @can('customer')
                                        href="{{ route('company.index', ['module' => $modules]) }}" 
                                            @endcan>
                                             Semua Kategori 
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-4 col-sm-8 col-xs-8 col-ts-12 middle-content container-vertical-wapper ">
                            <div class="search-form layout2 box-has-content">
                                <div class="search-block">
                                    <div class="search-choice">
                                        <select data-placeholder="All Categories" class="chosen-select">
                                            <option value="1">Semua Kategori</option>
                                            <option value="2">Electronics</option>
                                            <option value="3">Acessories</option>
                                            <option value="4">Table & Accessories</option>
                                            <option value="5">Headphone</option>
                                            <option value="6">Batteries & Chargens</option>
                                            <option value="7">Headphone & Headsets</option>
                                            <option value="8">Mp3 Player & Acessories</option>
                                        </select>
                                    </div>
                                    <div class="search-inner">
                                        <input type="text" class="search-info" placeholder="Cari...">
                                    </div>
                                    <a href="#" class="search-button"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>