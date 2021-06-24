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

class ProductContractController extends LayoutController {
    function __construct() {
        $this->middleware('permission:vendor', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function contract(Request $request, $code, $hash) {
        $contracts = Crypt::decryptString($hash);
        if($contracts == 'product_contract')
        DB::setDefaultConnection('mysql');
        $vendor_contract_master = VendorContractMaster::with(['vendor_master' => function($vm) {
                $vm->where('id', $this->user->id)
                ->orderBy('created_at', 'desc');
            }])
            ->has('vendor_master')
            ->whereHas('vendor_master', function ($vm){
                $vm->where('id', $this->user->id)
                ->orderBy('created_at', 'desc');
            })->orderBy('created_at', 'desc');
        if(isset($request->showAll)) {
            $pagePaginate = $vendor_contract_master->count();
            return view('vendor::product.contract.index',[
                'vendor_contract_master' => $vendor_contract_master->paginate($pagePaginate), 
                'style' => $this->user->group->style
            ])
            ->with('i', ($request->input('page', 1) - 1) * $pagePaginate);
        } else {
            return view('vendor::product.contract.index',[
                'vendor_contract_master' => $vendor_contract_master->paginate(10), 
                'style' => $this->user->group->style
            ])
            ->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function detail(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection('mysql');
        $vendor_contract_master = VendorContractMaster::with(['vendor_master' => function($vm) {
                $vm->where('id', $this->user->id)
                ->orderBy('created_at', 'desc');
            }])
            ->has('vendor_master')
            ->whereHas('vendor_master', function ($vm){
                $vm->where('id', $this->user->id)
                ->orderBy('created_at', 'desc');
            })
            ->where('id', $id)
            ->first();

        return view('vendor::product.contract.detail',[
                'vendor_contract_master' => $vendor_contract_master, 
                'style' => $this->user->group->style
            ]);
        
    }

    public function product_create(Request $request, $code, $hash) {

        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection('mysql');
        $vendor_contract_master = VendorContractMaster::find($id);
        
        $product_group_rules = new ProductGroupRule();
        $product_group_rules = $product_group_rules->setConnection($this->user->group->katalog);
        $product_group_rules = $product_group_rules->get();
        return view('vendor::product.contract.add', [
            'vendor_contract_master' => $vendor_contract_master,
            'category' => $this->get_category($this->user->group->katalog, $vendor_contract_master->category),
            'product_group_rules' => $product_group_rules,
            'style' => $this->user->group->style
        ]);
    }

    public function product_create_post(Request $request, $code, $id) {

        //echo json_encode($request->all());
        $this->validateForm($request, 'create');
        $product = new Product();
        $product = $product->setConnection($this->user->group->katalog);
        $product = $this->saveProduct($request, $product);

        // insert product group
        if($request->product_group){
            foreach($request->product_group as $group){
                $pg = new ProductGroup();
                $pg->rule_id = $group;
                $pg->product_id = $product->id;
                $pg->save();
            }
        }

        if($product) {
            $product_contract = new ProductContract();
            $product_contract = $product_contract->setConnection($this->user->group->katalog);
            $product_contract = $this->saveProductContract($request, $product_contract, $product);
            if($product_contract) {
                return redirect()->route('vendor.product.contract',[$this->user->group->code, Crypt::encryptString('product_contract')]);
            }
            
        }
    }

    public function validateForm($request, $type) {
        $messages = [
            'name.required' => 'Nama Produk wajib diisi !',
            'price.required' => 'Harga wajib diisi !',
            'unit.required' => 'Satuan wajib diisi !',
            'description.required' => 'Deskripsi wajib diisi !',
            'short_description.required' => 'Deskripsi singkat wajib diisi !',
            'stock.required' => 'Stok wajib diisi !',
            'sku.required' => 'SKU wajib diisi !',
            'vendor_sku.required' => 'Vendor SKU wajib diisi !',
            'category.required' => 'Kategori wajib dipilih !',
            'subcategory.required' => 'Sub kategori wajib dipilih !',
            // 'subsubcategory.required' => 'Sub sub kategori wajib dipilih !',
            'min' => ':attribute harus diisi minimal :min karakter!!!',
            'max' => ':attribute harus diisi maksimal :max karakter!!!'
        ];

        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'stock' => 'required',
            'sku' => 'required',
            'vendor_sku' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            // 'subsubcategory' => 'required'
        ],$messages);

        if($type == 'create') {
            return view('vendor::product.contract.add', [
                'data' => $request
            ]);
        }
    }

    public function saveProduct($request, $product) {
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
        $product->image = $request->file('image')->store('public/files');
        $product->small_image = $request->file('small_image')->store('public/files');
        $product->thumbnail = $request->file('thumbnail')->store('public/files');
        $product->status = 0;
        $product->created_at = date("Y-m-d H:i:s");
        $product->updated_at = date("Y-m-d H:i:s");
        $product->save();

        if($product) {
            $product_vendor = new ProductVendor();
            $product_vendor = $product_vendor->setConnection($this->user->group->katalog);
            $product_vendor->vendor_id = $this->user->vendor_katalog_id;
            $product_vendor->product_id = $product->id;
            $product_vendor->price = str_replace(',', '', $product->price);
            $product_vendor->stock = str_replace(',', '', $request->stock);
            $product_vendor->status = 0;
            $product_vendor->created_at = $product->created_at;
            $product_vendor->updated_at = $product->updated_at;
            $product_vendor->save();
        }

        return $product;
    }

    public function saveProductContract($request, $product_contract, $product) {

        $newcontract_start = date("Y-m-d H:i:s", strtotime($request->contract_start));
        $newcontract_end = date("Y-m-d H:i:s", strtotime($request->contract_end));

        $product_contract->vendor_id = $this->user->vendor_katalog_id;
        $product_contract->vendor_master_id = $request->vendor_master_id;
        $product_contract->vendor_contract_master_id = $request->vendor_contract_master_id;
        $product_contract->product_id = $product->id;
        $product_contract->contract_name = $request->contract_name;
        $product_contract->contract_no = $request->contract_no;
        $product_contract->contract_price = str_replace(',', '', $request->contract_price);
        $product_contract->contract_start = $newcontract_start;
        $product_contract->contract_end = $newcontract_end;
        $product_contract->category = $request->category;
        $product_contract->status = 0;
        $product_contract->created_at = date("Y-m-d H:i:s");
        $product_contract->updated_at = date("Y-m-d H:i:s");
        $product_contract->save();

        if($product_contract) {
            if($request->has('name_biaya') && $request->has('price_biaya')) {
                foreach($request->name_biaya as $index => $nb) {
                    $product_shipping = new ProductShipping();
                    $product_shipping = $product_shipping->setConnection($this->user->group->katalog);
                    $product_shipping->product_id = $product->id;
                    $product_shipping->name =  $nb;
                    $product_shipping->price =  str_replace(',', '', $request->price_biaya[$index]);
                    $product_shipping->created_at = date("Y-m-d H:i:s");
                    $product_shipping->updated_at = date("Y-m-d H:i:s");
                    $product_shipping->save();
                }
            }
            $category_product = new CategoryProduct();
            $category_product = $category_product->setConnection($this->user->group->katalog);
            $category_product->category_id = $request->category;
            $category_product->product_id = $product->id;
            $category_product->save();
            
            $category_product = new CategoryProduct();
            $category_product = $category_product->setConnection($this->user->group->katalog);
            $category_product->category_id = $request->subcategory;
            $category_product->product_id = $product->id;
            $category_product->save();
            
            if(isset($request->subsubcategory)){
                $category_product = new CategoryProduct();
                $category_product = $category_product->setConnection($this->user->group->katalog);
                $category_product->category_id = $request->subsubcategory;
                $category_product->product_id = $product->id;
                $category_product->save();
            }
        }

        return $product_contract;
    }

    public function subcategory(Request $request, $code) {
        $sub_sub_category = new \App\Category\Category;
        $sub_sub_category = $sub_sub_category->setConnection($this->user->group->katalog);
        $sub_sub_category = $sub_sub_category->where("parent_id", $request->id)->where("level", 4)->where("status", 1)->get();
        return json_encode($sub_sub_category);
    }
}
