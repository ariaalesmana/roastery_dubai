<div class="col-lg-7 col-md-3 col-sm-3 col-xs-5 midle-content">
    <div class="header-nav">
        <div class="header-nav-inner">
            <div class="box-header-nav">
                <div class=" container-wapper">
                    <a class="menu-bar mobile-navigation">
                        <span class="icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="text">Main Menu</span>
                    </a>
                    <a class="header-top-menu-mobile"><span class="fa fa-cog" aria-hidden="true"></span></a>
                    <ul id="menu-main-menu" class="main-menu clone-main-menu ovic-clone-mobile-menu box-has-content">
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
                        {{-- <li class="menu-">
                            <a class="kt-item-title ovic-menu-item-title">Vendor</a>
                        </li> --}}
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