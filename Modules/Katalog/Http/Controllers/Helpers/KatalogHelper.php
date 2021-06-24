<?php

use App\Product\ProductVendor;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Group\group;
use App\Vendor\vendor;

if (! function_exists('get_list_katalog')) {
    function get_list_katalog() {
        $list_katalog = DB::connection('mysql')->table('list_katalogs')->get();
        return $list_katalog;
    }
}

if (! function_exists('get_list_vendor')) {
    function get_list_vendor() {
        $vendor = vendor::where('status', 1)->get();
        return $vendor;
    }
}

if (! function_exists('katalog_related_product')) {
    function katalog_related_product($product_name, $category, $id, $user) {
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
}