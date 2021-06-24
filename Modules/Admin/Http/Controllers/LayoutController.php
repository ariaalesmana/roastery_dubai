<?php

namespace Modules\Admin\Http\Controllers;

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
        $style = style::find(1);
        return $style;
    }

    public function checkCode() {
        $inamartCode = null;
        $generateCode = $this->generateCode();
        $vendor_code_master = VendorCodeMaster::where('inamart_code', $generateCode)->first();
        if(!isset($vendor_code_master)) {
            $inamartCode = $generateCode;
        } else {
            $inamartCode = $this->checkCode();
        }
        return $inamartCode;
    }

    public function generateCode() {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < 8; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return 'ISJ-'.$code;
    }
}
