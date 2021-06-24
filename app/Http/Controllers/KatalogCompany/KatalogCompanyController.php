<?php

namespace App\Http\Controllers\KatalogCompany;

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
use App\Group\group;

class KatalogCompanyController extends LayoutController {
    
    function __construct() {
        $this->middleware('permission:customer', ['only' => ['index', 'sub_sub_ctg', 'sub_ctg', 'get_ctg', 'detail_product', 'related_product', 'get_category', 'get_sub_category', 'get_sub_sub_category']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code) {

        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);

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
            ->whereHas('product_group.product_group_rules', function ($agpagr){
                $agpagr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
            });
        
        return view('katalog::katalog_company.index', [
            'product' => $product->paginate(10),
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8);
    }

    public function detail_product(Request $request, $code, $hash) {

        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);

        $product_detail = ProductVendor::with(['vendor'])
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
            ->whereHas('product_group.product_group_rules', function ($agpagr){
                $agpagr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
            })
            ->where('product_vendor.id', $id);

        $category = CategoryProduct::select('category_id')->where('product_id', $product_detail->first()->product_id)->get();
        $product_name = explode(" ", $product_detail->first()->product->name);

        return view('katalog::katalog_company.product.detail', [
            'product_detail' => $product_detail->first(), 
            'category' => $this->get_ctg(),
            'related_product' => $this->related_product($product_name, $category, $id)->paginate(5)->onEachSide(1),
            'style' => $this->get_style(),
            'code_url' => $code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function related_product($product_name, $category, $id) {

        $related_product = ProductVendor::with(['vendor'])
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
            ->whereHas('product_group.product_group_rules', function ($agpagr){
                $agpagr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
            })
            ->whereHas('category_product', function ($cp) use ($category){
                $cp->whereIn('category_id', $category);
            })->whereHas('product', function ($p) use ($product_name) {
                for($i = 0; $i < count($product_name); $i++) {
                    if ($i == 0) {
                        $p->where('name', 'like', '%'.$product_name[$i].'%');
                    } else if ($i > 0 && $i <= 2) {
                        $p->orWhere('name', 'like', '%'.$product_name[$i].'%');
                    }
                }
            })
            ->where('product_vendor.id', '!=', $id);;

        return $related_product;
    }

    public function get_category(Request $request, $code, $hash) {

        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection('katalog_ap2');

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
            ->with(['category_product'])
            ->has('category_product')
            ->has('product')
            ->whereHas('product', function ($p){
                $p->where('status', 1);
            })
            ->whereHas('product_group.product_group_rules', function ($agpagr){
                $agpagr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
            })->whereHas('category_product', function ($cp) use ($id){
                $cp->where('category_product.category_id', $id);
            });
        
        return view('katalog::katalog_company.index', [
            'product' => $product->paginate(10),
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => 'ap2'
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8);
    }

    public function get_sub_category(Request $request, $code, $hash) {

        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection('katalog_ap2');

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
            ->with(['category_product'])
            ->has('category_product')
            ->has('product')
            ->whereHas('product', function ($p){
                $p->where('status', 1);
            })
            ->whereHas('product_group.product_group_rules', function ($agpagr){
                $agpagr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
            })->whereHas('category_product', function ($cp) use ($id){
                $cp->where('category_product.category_id', $id);
            });
        
        return view('katalog::katalog_company.index', [
            'product' => $product->paginate(10),
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => 'ap2'
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8);
    }

    public function get_sub_sub_category(Request $request, $code, $hash) {

        $id = Crypt::decryptString($hash);

        DB::setDefaultConnection('katalog_ap2');

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
            ->with(['category_product'])
            ->has('category_product')
            ->has('product')
            ->whereHas('product', function ($p){
                $p->where('status', 1);
            })
            ->whereHas('product_group.product_group_rules', function ($agpagr){
                $agpagr->whereIn('cust_groups', $this->user->customer_grouping()->select('customer_group_id')->get());
            })->whereHas('category_product', function ($cp) use ($id){
                $cp->where('category_product.category_id', $id);
            });
        
        return view('katalog::katalog_company.index', [
            'product' => $product->paginate(10),
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => 'ap2'
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8);
    }
}
