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
use App\Katalog\ListKatalog;
use App\Group\group;
use App\Repositories\GuestRepository;
use Illuminate\Support\Facades\Crypt;

class GuestController extends LayoutController {
    
    protected $guestRepository;

    function __construct(GuestRepository $guestRepository) {
        $this->guestRepository = $guestRepository;
    }
    public function redirect(Request $request) {
        return redirect('/coffee-dubai');
    }

    public function index(Request $request) {
        DB::setDefaultConnection('mysql');

        $prod = ListKatalog::all();
        $dbkat = array();

        foreach($prod as $p) {
            array_push($dbkat, group::where('code', $p->code)->first());
        }

        $product = [];

        foreach($dbkat as $index => $db) {
            $conn[$index] = $db->katalog;
            DB::setDefaultConnection($conn[$index]);
            $q = ProductVendor::select('product_vendors.*')
                ->join('product_groups as pg', 'pg.product_id', 'product_vendors.product_id')
                ->join('product_group_rules as pgr', function($join) {
                    $join->on('pg.rule_id', 'pgr.id')->whereIn('cust_groups', [1]);
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

            $q = $q->addSelect(DB::raw("'".$db->code."' as code"));

            if($index < 1){
                $product = $q;
            } else {
                $product->union($q);
            }
            
        }

        $prod = $product->paginate(10);
        $prod->appends($request->only('keyword'));
        return view('katalog.index', [
            'product' => $prod,
            'category' => $this->get_ctg(),
            'style' => $this->get_style()
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8);
    }

    public function detail_product(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product_detail = $this->guestRepository->katalog_detail_product($id);
        $related_product = $this->guestRepository->related_product($product_detail, $id, $code)->paginate(5)->onEachSide(1);
        return view('katalog.product.detail.index', [
            'product_detail' => $product_detail->first(),
            'category' => $this->get_ctg(),
            'related_product' => $related_product,
            'style' => $this->get_style(),
            'code_url' => $code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 5)->with('search', $request->input('search'));
    }
}
