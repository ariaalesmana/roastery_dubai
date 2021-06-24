<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use App\Category\Category;
use App\Product\Product;
use App\Product\ProductVendor;

class TestController extends Controller {
    
    public function index(Request $request) {
        $arrayProduct = array();

        DB::setDefaultConnection('katalog_ap2');
        $product_vendor = ProductVendor::all();

        foreach($product_vendor as $p) {
            array_push($arrayProduct, ['id' => $p->id, 'product_id' => $p->product_id, 'hash' => hash('sha256', $p->id . $p->product_id . 'katalog_ap2')]);
        }

        foreach($product_vendor as $index => $p) {
            if($p->id == $arrayProduct[$index]['id']) {
                $insertproduct = ProductVendor::find($p->id);
                $insertproduct->hash = $arrayProduct[$index]['hash'];
                $insertproduct->save();
            }
        }
        echo json_encode($arrayProduct);
    }

    public function index7(Request $request) {
        return view('katalog.index7');
    }
}
