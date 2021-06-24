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
use App\Vendor\VendorAddress;
use App\Vendor\VendorMaster;
use App\Vendor\VendorAddressMaster;
use App\Vendor\VendorCodeMaster;
use App\Vendor\VendorContractMaster;
use App\Product\ProductVendor;
use App\Product\ProductContract;
use App\Product\ProductShipping;
use App\Category\CategoryProduct;
use App\Lokasi\Location;
use App\Product\ProductGroup;
use App\Product\ProductGroupRule;
use App\Group\group;
use App\Style\style;
use Illuminate\Support\Facades\Crypt;

class ProductController extends LayoutController {
    function __construct() {
        $this->middleware('permission:vendor', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $products = Crypt::decryptString($hash);
        if($products == 'product')
        DB::setDefaultConnection($this->user->group->katalog);
        $product = new ProductVendor;
        $product = $product->vendor_get_daftar_product($this->user->vendor_katalog_id)->paginate(10);
        return view('vendor::product.daftar_produk', [
            'product' => $product, 
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function detail(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = new ProductVendor;
        $product = $product->vendor_get_detail_product($id);
        $category_product = CategoryProduct::select('category_id')->where('product_id', $id)->get();
        $product_group_rules = ProductGroupRule::all();
        return view('vendor::product.detail_produk',[
            'product' => $product, 
            'category_product' => $category_product, 
            'product_group_rules' => $product_group_rules,
            'style' => $this->user->group->style
        ]);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = new ProductVendor;
        $product = $product->vendor_get_detail_product($id);
        $category_product = CategoryProduct::select('category_id')->where('product_id', $id)->get();
        $product_group_rules = ProductGroupRule::all();
        return view('vendor::product.edit_produk',[
            'product' => $product, 
            'category_product' => $category_product,
            'product_group_rules' => $product_group_rules,
            'style' => $this->user->group->style
        ]);
    }

    public function subcategory(Request $request, $code) {
        $sub_sub_category = new \App\Category\Category;
        $sub_sub_category = $sub_sub_category->setConnection($this->user->group->katalog);
        $sub_sub_category = $sub_sub_category->where("parent_id", $request->id)->where("level", 4)->where("status", 1)->get();
        return json_encode($sub_sub_category);
    }

    public function hapusQR(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        // $products = Crypt::decryptString($id);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = Product::find($id);
        $product->qrcode = null;
        $product->save();

        return redirect()->back();
    }

    public function edit_post(Request $request, $code) {
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $status = 0;
        if($request->has('status_product')) {
            $status = $request->status_product;
        } else {
            $status = 0;
        }
        $product = Product::find($request->product_id);
        $product->status = $status;
        $product->name = $request->name;
        if($request->has('qr')){
            $product->qrcode = $request->file('qr')->store('public/files');
        }
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->price = str_replace(',', '', $request->price);
        $product->unit = $request->unit;
        $product->sku = $request->sku;
        $product->vendor_sku = $request->vendor_sku;
        // $product->image = null;
        // $product->small_image = null;
        // $product->thumbnail = null;
        if($request->has('image')){
            $product->image = $request->file('image')->store('public/files');
        }
        if($request->has('small_image')){
            $product->small_image = $request->file('small_image')->store('public/files');
        }
        if($request->has('thumbnail')){
            $product->thumbnail = $request->file('thumbnail')->store('public/files');
        }
        $product->updated_at = date("Y-m-d H:i:s");
        $product->save();

        foreach($request->product_group as $g){
            if($g != 2) { // jika bukan general
                $cek = ProductGroup::where('product_id', $request->product_id)->where('rule_id', 2)->first();
                if(!$cek){ // jika produk tidak memiliki group general
                    $pg = new ProductGroup();
                    $pg->rule_id = 2;
                } else { 
                    $pg = ProductGroup::where('product_id', $request->product_id)->where('rule_id', $g)->first();
                    $pg->rule_id = $g;
                }
                $pg->product_id = $request->product_id;
                $pg->save();
            } else { // jika general
                $pg = ProductGroup::where('product_id', $request->product_id)->where('rule_id', $g)->first();
                $pg->rule_id = $g;
                $pg->product_id = $request->product_id;
                $pg->save();
            }
        }

        // $pg = ProductGroup::where('product_id', $request->product_id)->where('rule_id', '!=', 2)->first();
        // if($pg == null) {
        //     $pg = new ProductGroup;
        //     $pg->rule_id = $request->product_group;
        //     $pg->product_id = $request->product_id;
        //     $pg->save();
        // } else {
        //     $pg->rule_id = $request->product_group;
        //     $pg->product_id = $request->product_id;
        //     $pg->save();
        // }
        // $pgGeneral = ProductGroup::where('product_id', $request->product_id)->where('rule_id', 2)->first();
        // if($pgGeneral == null) {
        //     $pgGeneral = new ProductGroup;
        //     $pgGeneral->rule_id = 2;
        //     $pgGeneral->product_id = $request->product_id;
        //     $pgGeneral->save();
        // }

        if($product) {
            $product_vendor = ProductVendor::find($request->id);
            $product_vendor->status = $status;
            $product_vendor->save();
            if($product_vendor) {
                $product_contract = ProductContract::where('product_id', $request->product_id)->first();
                $product_contract->status = $status;
                $product_contract->save();

                if($product_contract) {
                    return redirect()->route('vendor.product',[$this->user->group->code, Crypt::encryptString('product')]);
                }
            }
        }
    }
}
