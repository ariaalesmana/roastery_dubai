<?php

namespace Modules\Vendor\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Vendor\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Category\Category;
use App\Product\Product;
use App\Vendor\vendor;
use App\Product\ProductVendor;
use App\Category\CategoryProduct;
use App\Lokasi\Location;
use App\Style\style;

class VendorController extends LayoutController {

    function __construct() {
        $this->middleware('permission:vendor', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index() {

        DB::setDefaultConnection('mysql');
        return view('vendor::index', [
            'style' => $this->user->group->style
        ]);
    }
}
