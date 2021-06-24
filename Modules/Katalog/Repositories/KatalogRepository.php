<?php

namespace Modules\Katalog\Repositories;

use Auth;
use DB;
use App\Product\ProductVendor;
use App\Category\CategoryProduct;

class KatalogRepository {

    public function katalog_home($user, $request) {
        $product = ProductVendor::select('product_vendors.*')
        ->join('product_groups as pg', 'pg.product_id', 'product_vendors.product_id')
        ->join('product_group_rules as pgr', function($join) use($user) {
            $join->on('pg.rule_id', 'pgr.id')->whereIn('cust_groups', $user->customer_grouping()->select('customer_group_id')->get()->pluck('customer_group_id'));
        })
        ->with(['vendor'])
        ->with(['product'])
        ->has('product')
        ->whereHas('product', function ($p){
            $p->where('status', 1);
        })
        ->when($request->keyword, function ($query) use ($request) {
            $query->where('description', 'like', "%{$request->keyword}%")
            ->orWhereHas('product', function ($p) use($request) {
                $p->where('name', 'like', "%{$request->keyword}%");
            })
            ->orWhereHas('product', function ($p) use($request) {
                $p->where('description', 'like', "%{$request->keyword}%");
            })
            ->orWhereHas('product', function ($p) use($request) {
                $p->where('short_description', 'like', "%{$request->keyword}%");
            })
            ->orWhereHas('vendor', function ($p) use($request) {
                $p->where('vendor_name', 'like', "%{$request->keyword}%");
            });
        })
        ->when($request->filtervendor, function ($query) use ($request) {
            $query->where('vendor_id', $request->filtervendor);
        })->where('status', 1);
        return $product;
    }

    public function katalog_detail_product($id, $user) {
        $product_detail = ProductVendor::select('product_vendors.*')
            ->join('product_groups as pg', 'pg.product_id', 'product_vendors.product_id')
            ->join('product_group_rules as pgr', function($join) use($user) {
                $join->on('pg.rule_id', 'pgr.id')
                    ->whereIn('cust_groups', $user->customer_grouping()->select('customer_group_id')->get()->pluck('customer_group_id'));
            })
            ->with(['vendor'])
            ->with(['product'])
            ->has('product')
            ->whereHas('product', function ($p){
                $p->where('status', 1);
            })
            ->where('product_vendors.id', $id)
            ->where('status', 1);
        return $product_detail;
    }

    public function related_product($product_detail, $id) {
        $category = CategoryProduct::select('category_id')->where('product_id', $product_detail->first()->product_id)->get();
        $product_name = explode(" ", $product_detail->first()->product->name);
        $related_product = $this->katalog_related_product($product_name, $category, $id, Auth::user());
        return $related_product;
    }

    public function katalog_related_product($product_name, $category, $id, $user) {
        $related_product = ProductVendor::select('product_vendors.*')
            ->join('product_groups as pg', 'pg.product_id', 'product_vendors.product_id')
            ->join('product_group_rules as pgr', function($join) use($user) {
                $join->on('pg.rule_id', 'pgr.id')
                    ->whereIn('cust_groups', $user->customer_grouping()->select('customer_group_id')->get()->pluck('customer_group_id'));
            })
            ->with(['vendor'])
            ->with(['product'])
            ->has('product')
            ->whereHas('product', function ($p){
                $p->where('status', 1);
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
            ->where('product_vendors.id', '!=', $id)
            ->where('status', 1);
        return $related_product;
    }

    public function katalog_by_category($id, $user) {
        $product = ProductVendor::with(['vendor'])
            ->with(['product'])
            ->with(['product_group' => function($agp) use($user) {
                $agp->with(['product_group_rules' => function($agr) use($user) {
                    $agr->whereIn('cust_groups', $user->customer_grouping()->select('customer_group_id')->get());
                }])
                ->whereHas('product_group_rules', function ($agr) use($user) {
                    $agr->whereIn('cust_groups', $user->customer_grouping()->select('customer_group_id')->get());
                });
            }])
            ->with(['category_product'])
            ->has('category_product')
            ->has('product')
            ->whereHas('product', function ($p){
                $p->where('status', 1);
            })
            ->whereHas('product_group.product_group_rules', function ($agpagr) use($user) {
                $agpagr->whereIn('cust_groups', $user->customer_grouping()->select('customer_group_id')->get());
            })->whereHas('category_product', function ($cp) use ($id){
                $cp->where('category_products.category_id', $id);
            })
            ->where('status', 1);

        return $product;
    }
}