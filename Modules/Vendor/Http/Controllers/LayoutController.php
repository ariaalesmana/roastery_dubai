<?php

namespace Modules\Vendor\Http\Controllers;

use App\Http\Controllers\Controller;
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
use App\Katalog\ListKatalog;
use App\Vendor\VendorCodeMaster;
use Illuminate\Support\Facades\Hash;

class LayoutController extends Controller {
    
    public function get_style() {
        $style = new style();
        $style = $style->setConnection('mysql');
        $style = $style->find(1);
        return $style;
    }

    public function get_category($db, $category_id) {
        $category = new Category();
        $category = $category->setConnection($db);
        $category = $category->find($category_id);
        return $category;
    }
}
