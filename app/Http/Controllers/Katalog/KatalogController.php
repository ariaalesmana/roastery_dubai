<?php

namespace App\Http\Controllers\Katalog;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LayoutController;
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

class KatalogController extends LayoutController {

    function __construct() {
        $this->middleware('permission:customer', ['only' => ['index', 'sub_sub_ctg', 'sub_ctg', 'get_ctg', 'detail_product', 'related_product', 'get_category', 'get_sub_category', 'get_sub_sub_category']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function redirect() {
        return redirect()->route('katalog', [$this->user->group()->first()->code]);
    }

    public function index(Request $request) {

        DB::setDefaultConnection($this->user->group()->first()->katalog);

        $product = ProductVendor::with(['vendor'])
            ->with(['product'])
            ->with(['product_group' => function($agp){
                $agp->with(['product_group_rules' => function($agr){
                    $agr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
                }])
                ->whereHas('product_group_rules', function ($agr){
                    $agr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
                });
            }])
            ->has('product')
            ->whereHas('product', function ($p){
                $p->where('status', 1);
            })
            ->whereHas('product_group.product_group_rules', function ($agpagr) {
                $agpagr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
            });
        
        return view('katalog.index', [
            'product' => $product->paginate(10),
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $this->user->group()->first()->code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8);
    }
}
