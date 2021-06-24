<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin', [Auth()->user()->group->code]) }}">
                    <i class="nav-icon icon-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-cogs"></i> Vendor
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.vendor', [Auth()->user()->group->code, Crypt::encryptString('adminDaftarVendor')]) }}">
                            <i class="nav-icon fa fa-registered"></i> Daftar Vendor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.vendor.contract', [Auth()->user()->group->code, Crypt::encryptString('contract')]) }}">
                            <i class="nav-icon fa fa-check-circle-o"></i> Kontrak Vendor
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-cogs"></i> Daftar Customer
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customer', [Auth()->user()->group->code, Crypt::encryptString('customer')]) }}">
                            <i class="nav-icon icon-grid"></i> Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customer_group', [Auth()->user()->group->code, Crypt::encryptString('customer_group')]) }}">
                            <i class="nav-icon icon-grid"></i> Customer Group
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-cogs"></i> Produk
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.product', [Auth()->user()->group->code, Crypt::encryptString('product')]) }}">
                            <i class="nav-icon icon-speedometer"></i> Daftar Produk
                        </a>
                    </li>
                </ul>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.product_group', [Auth()->user()->group->code, Crypt::encryptString('product_group')]) }}">
                            <i class="nav-icon icon-speedometer"></i> Produk Group
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-cogs"></i> Kategori
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.category', [Auth()->user()->group->code, Crypt::encryptString('category')]) }}">
                            <i class="nav-icon icon-speedometer"></i> Kategori
                        </a>
                    </li>
                </ul>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.subcategory', [Auth()->user()->group->code, Crypt::encryptString('subcategory')]) }}">
                            <i class="nav-icon icon-speedometer"></i> Sub Kategori
                        </a>
                    </li>
                </ul>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.subsubcategory', [Auth()->user()->group->code, Crypt::encryptString('subsubcategory')]) }}">
                            <i class="nav-icon icon-speedometer"></i> Sub Sub Kategori
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon fa fa-cogs"></i> Pemesanan 
                    <span class="badge badge-danger">{{ count_cart(Auth::user()) + count_order(Auth::user()) + count_po(Auth::user()) }}</span>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.cart', [Auth()->user()->group->code, Crypt::encryptString('admincart')]) }}">
                            <i class="nav-icon icon-grid"></i> Produk Dipesan 
                            <span class="badge badge-warning">{{ count_cart(Auth::user()) }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.order', [Auth()->user()->group->code, Crypt::encryptString('adminorder')]) }}">
                            <i class="nav-icon icon-grid"></i> Order 
                            <span class="badge badge-warning">{{ count_order(Auth::user()) }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.orders.po', [Auth()->user()->group->code, Crypt::encryptString('adminpo')]) }}">
                            <i class="nav-icon icon-grid"></i> PO
                            <span class="badge badge-warning">{{ count_po(Auth::user()) }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>