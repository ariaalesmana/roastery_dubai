<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Product\Product;
use App\Product\ProductVendor;
use App\Product\ProductGroup;
use App\Product\ProductGroupRule;
use App\Product\ProductContract;
use App\Category\CategoryProduct;
use App\Group\group;
use Illuminate\Support\Facades\Crypt;
use Modules\Admin\Repositories\ProductRepository;

class ProductController extends LayoutController {

    protected $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    public function index(Request $request, $code, $hash) {
        $products = Crypt::decryptString($hash);

        if($products == 'product')
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = $this->productRepository->adminGetDaftarProduct($request, $this->user->group->id)->paginate(10);
        $product->appends($request->only('keyword'));

        return view('admin::product.daftar_produk',[
            'product' => $product,
            'style'   => $this->user->group->style,
            'keyword' => $request->keyword
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = new ProductVendor;
        $product = $this->productRepository->adminGetDetailProduct($id);

        $cp  = CategoryProduct::select('category_id')->where('product_id', $id)->get();
        $pgr = ProductGroupRule::all();
        
        return view('admin::product.edit_produk',[
            'product'             => $product, 
            'category_product'    => $cp,
            'product_group_rules' => $pgr,
            'style'               => $this->user->group->style
        ]);
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
                    return redirect()->route('admin.product',[$this->user->group->code, Crypt::encryptString('product')]);
                }
            }
        }
    }
}
