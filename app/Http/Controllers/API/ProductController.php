<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Product\ProductVendor;
use App\Product\Product;
use App\Product\ProductGroup;
use App\Product\ProductGroupRule;
use App\Vendor\VendorContractMaster;
use App\Product\ProductContract;
use App\Category\CategoryProduct;
use App\Vendor\VendorMaster;
use App\Category\Category;
use App\Batch;
use DB;

class ProductController extends Controller
{
    public $successStatus = 401;

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        DB::setDefaultConnection($this->user->group->katalog);
        $product = ProductVendor::with(['product'])
            ->has('product')
            ->whereHas('product', function ($p) {
                $p->where('status', 1);
            })
            ->where('vendor_id', $this->user->vendor_katalog_id)->get();

        $this->successStatus = 200;
        $success['success'] = true;
        $success['product'] = $product;

        return response()->json($success, $this->successStatus);
    }

    public function detail(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;
        $success['product']   = ProductVendor::find($id);

        return response()->json($success, $this->successStatus);
    }

    public function delete(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $product = ProductVendor::find($id);
        $product->delete();
        $this->successStatus = 200;
        $success['success'] = true;
        return response()->json($success, $this->successStatus);
    }

    public function add_detail(Request $request)
    {
        DB::setDefaultConnection('mysql');
        $cat = VendorContractMaster::select('category')->where('vendor_master_id', Auth::user()->id)->get()->pluck('category');

        $category = new Category;
        $category = $category->setConnection($this->user->group->katalog);
        $success['category'] = $category->whereIn('id', $cat)->get();

        $product_group_rules = new ProductGroupRule;
        $product_group_rules = $product_group_rules->setConnection($this->user->group->katalog);
        $success['product_group_rules'] = $product_group_rules->get();

        $batch = new Batch;
        $batch = $batch->setConnection($this->user->group->katalog);
        $success['batch'] = $batch->get();

        $this->successStatus = 200;
        $success['success'] = true;

        return response()->json($success, $this->successStatus);
    }

    public function sub_category(Request $request, $id)
    {
        $category = new Category;
        $category = $category->setConnection($this->user->group->katalog);
        $success['subcategory'] = $category->where('level', 3)->where('parent_id', $id)->get();

        $this->successStatus = 200;
        $success['success'] = true;

        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request)
    {
        $product = new Product;
        $product = $product->setConnection($this->user->group->katalog);
        $product                    = new Product;
        $product                    = $product->setConnection($this->user->group->katalog);
        $product->name              = $request->name;
        $product->description       = $request->description;
        $product->short_description = $request->short_description;
        $product->price             = str_replace(',', '', $request->price);
        $product->unit              = $request->unit;
        $product->sku               = $request->sku;
        $product->vendor_sku        = $request->vendor_sku;
        $product->status            = 1;
        $product->batch_id          = $request->batch_id;
        $product->tgl_produksi      = $request->tgl_produksi;
        $product->weight            = $request->weight;
        $product->save();

        if ($request->hasFile('files')) {
            $files          = $request->file('files');
            $files->move(public_path("images/product/") . $this->user->group->katalog . '/' . $this->user->id . '/image/' . $product->id, $request->fileName);
            $product->image  = "images/product/" . $this->user->group->katalog . '/' . $this->user->id . '/image/' . $product->id . '/' . $request->fileName;
            $product->save();
        }

        if ($request->hasFile('files_gambar')) {
            $files          = $request->file('files_gambar');
            $files->move(public_path("images/product/") . $this->user->group->katalog . '/' . $this->user->id . '/image/' . $product->id, $request->fileName);
            $product->thumbnail  = "images/product/" . $this->user->group->katalog . '/' . $this->user->id . '/image/' . $product->id . '/' . $request->fileName;
            $product->save();
        }

        $pg = new ProductGroup;
        $pg = $pg->setConnection($this->user->group->katalog);
        $pg->rule_id = 1;
        $pg->product_id = $product->id;
        $pg->save();

        $product_vendor = new ProductVendor;
        $product_vendor = $product_vendor->setConnection($this->user->group->katalog);
        $product_vendor->vendor_id = $this->user->vendor_katalog_id;
        $product_vendor->product_id = $product->id;
        $product_vendor->price = str_replace(',', '', $product->price);
        $product_vendor->stock = str_replace(',', '', $request->stock);
        $product_vendor->status = 1;
        $product_vendor->save();

        $vcm = new VendorContractMaster;
        $vcm = $vcm->setConnection('mysql');
        $vcm = $vcm->where('vendor_master_id', $this->user->id)->where('category', $request->category)->first();

        $product_contract = new ProductContract;
        $product_contract = $product_contract->setConnection($this->user->group->katalog);

        $product_contract->vendor_id = $this->user->vendor_katalog_id;
        $product_contract->vendor_master_id = $this->user->id;
        $product_contract->vendor_contract_master_id = $vcm->id;
        $product_contract->product_id = $product->id;
        $product_contract->contract_name = $vcm->contract_name;
        $product_contract->contract_no = $vcm->contract_no;
        $product_contract->contract_price = $vcm->contract_price;
        $product_contract->contract_start = $vcm->contract_start;
        $product_contract->contract_end = $vcm->contract_end;
        $product_contract->category = $request->category;
        $product_contract->status = 1;
        $product_contract->save();

        $category_product = new CategoryProduct;
        $category_product = $category_product->setConnection($this->user->group->katalog);
        $category_product->category_id = $request->category;
        $category_product->product_id = $product->id;
        $category_product->save();

        if (isset($request->subcategory)) {
            $category_product = new CategoryProduct;
            $category_product = $category_product->setConnection($this->user->group->katalog);
            $category_product->category_id = $request->subcategory;
            $category_product->product_id = $product->id;
            $category_product->save();
        }

        $this->successStatus = 200;
        $success['success']  = true;
        $success['product']     = $product;
        $batch = new Batch;
        $batch = $batch->setConnection($this->user->group->katalog);
        $success['batch']    = $batch->find($product->batch_id);

        return response()->json($success, $this->successStatus);
    }
}
