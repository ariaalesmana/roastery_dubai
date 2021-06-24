<div class="col-lg-4 col-md-5 col-sm-12 left-content">
    <div class="vertical-wapper parent-content">
        <div class="block-title show-content" style="background-color: #00c4cc">
            {{-- <span class="icon-bar">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="text">Kategori</span> --}}
        </div>
        {{-- <a class="menu-bar mobile-navigation">
            <span class="icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a> --}}
        {{-- <a class="header-top-menu-mobile"><span class="fa fa-cog" aria-hidden="true"></span></a> --}}
        {{-- <div class="vertical-content hidden-content"> --}}
            {{-- <ul class="vertical-menu ovic-clone-mobile-menu">
                @foreach ($category as $cat)
                    <li class="menu-item-has-children has-megamenu">
                        <a
                            @can('customer')
                            href="{{ route('katalog.get_category', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($cat['id'])]) }}"
                            @endcan
                            class="ovic-menu-item-title">
                            {{ $cat['name'] }}
                        </a>
                        <a class="toggle-sub-menu"></a>
                        <div class="sub-menu sub-menu1 mega-menu">
                            <div class="row">
                                @foreach ($cat['sub_category'] as $sub_cat)
                                    <div class="widget-custom-menu col-md-6">
                                        <a
                                            @can('customer')
                                            href="{{ route('katalog.get_sub_category', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($sub_cat['id'])]) }}"
                                            @endcan>
                                            <h5 class="title widgettitle">{{ $sub_cat['name'] }}</h5>
                                        </a>
                                        <ul>
                                            @foreach ($sub_cat['sub_sub_category'] as $sub_sub_cat)
                                                <li>
                                                    <a
                                                        @can('customer')
                                                        href="{{ route('katalog.get_sub_sub_category', [$code_url, Illuminate\Support\Facades\Crypt::encryptString($sub_sub_cat['id'])]) }}"
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
            </ul> --}}
            {{-- <div class="view-all-categori">
                <a @can('customer')
                href="{{ route('katalog.index') }}"
                    @endcan>
                     Semua Kategori
                </a>
            </div> --}}
        {{-- </div> --}}
    </div>
</div>