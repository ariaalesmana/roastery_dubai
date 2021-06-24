<?php

namespace Modules\Admin\Repositories;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Storage;
use App\Http\libraries\Session;
use App\Product\ProductVendor;

class ProductRepository {

    public function adminGetDaftarProduct($request, $group_id) {
        $p = ProductVendor::with(['vendor'])
            ->with(['product'])
            ->whereHas('product', function ($p) {
                $p->whereIn('status', [0,1]);
            })
            ->has('product')
            ->when($request->keyword, function ($query) use ($request, $group_id) {
                $query->where(function ($q) use ($request, $group_id) {
                    $q->where('description', 'like', "%{$request->keyword}%")
                    ->orWhereHas('product', function ($p) use($request, $group_id) {
                        $p->where('name', 'like', "%{$request->keyword}%")
                          ->orderBy('updated_at', 'desc');
                    })
                    ->orWhereHas('vendor', function ($p) use($request, $group_id) {
                        $p->where('vendor_id', $group_id)
                          ->where('vendor_name', 'like', "%{$request->keyword}%")
                          ->orderBy('updated_at', 'desc');
                    });
                });
            })
            ->orderBy('created_at', 'desc');
        return $p;
    }
    
    public function adminGetDetailProduct($id) {
        $pv = ProductVendor::with(['vendor'])
        ->with(['product'])
        ->whereHas('product', function ($p){
            $p->whereIn('status', [0,1]);
        })
        ->has('product')
        ->where('product_id', $id)
        ->first();

        return $pv;
    }
}