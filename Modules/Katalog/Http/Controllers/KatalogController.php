<?php

namespace Modules\Katalog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Katalog\Http\Controllers\LayoutController;
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
use Illuminate\Support\Facades\Crypt;
use Modules\Katalog\Repositories\KatalogRepository;

class KatalogController extends LayoutController {

    protected $katalogRepository;

    function __construct(KatalogRepository $katalogRepository) {
        $this->middleware('auth');
        $this->middleware('permission:customer', ['only' => ['index', 'sub_sub_ctg', 'sub_ctg', 'get_ctg', 'detail_product', 'related_product', 'get_category', 'get_sub_category', 'get_sub_sub_category']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->katalogRepository = $katalogRepository;
    }

    public function index(Request $request, $code) {
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = $this->katalogRepository->katalog_home($this->user, $request)->paginate(10);
        $product->appends($request->only('keyword'));
        
        return view('katalog::home.index', [
            'product' => $product,
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $code,
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8);
    }

    public function detail_product(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product_detail = $this->katalogRepository->katalog_detail_product($id, $this->user);
        $related_product = $this->katalogRepository->related_product($product_detail, $id)->paginate(5)->onEachSide(1);
        return view('katalog::product.detail.index', [
            'product_detail' => $product_detail->first(),
            'category' => $this->get_ctg(),
            'related_product' => $related_product,
            'style' => $this->get_style(),
            'code_url' => $code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 5)->with('search', $request->input('search'));
    }

    public function get_category(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = $this->katalogRepository->katalog_by_category($id, $this->user)->paginate(10);
        return view('katalog::home.index', [
            'product' => $product,
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8)->with('search', $request->input('search'));
    }

    public function get_sub_category(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = $this->katalogRepository->katalog_by_category($id, $this->user)->paginate(10);
        return view('katalog::home.index', [
            'product' => $product,
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8)->with('search', $request->input('search'));
    }

    public function get_sub_sub_category(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $product = $this->katalogRepository->katalog_by_category($id, $this->user)->paginate(10);
        return view('katalog::home.index', [
            'product' => $product,
            'category' => $this->get_ctg(),
            'style' => $this->get_style(),
            'code_url' => $code
        ])
        ->with('i', ($request->input('page', 1) - 1) * 8)->with('search', $request->input('search'));
    }
}
