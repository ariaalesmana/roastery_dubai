<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Product\ProductGroupRule;
use App\Group\group;
use App\Customer\CustomerGroup;
use Illuminate\Support\Facades\Crypt;
use Modules\Admin\Repositories\ProductRepository;

class ProductGroupController extends LayoutController {

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
        $product_groups = Crypt::decryptString($hash);

        if($product_groups == 'product_group')
        $pgr = new ProductGroupRule;
        $pgr = $pgr->setConnection($this->user->group->katalog)->paginate(10);
        $pgr->appends($request->only('keyword'));

        return view('admin::product.product_group.produk_group', [
            'product_group_rules' => $pgr, 
            'style'               => $this->user->group->style,
            'keyword'             => $request->keyword
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create(Request $request, $code) {
        $cg  = CustomerGroup::where('group_id', $this->user->group->id)->get();

        return view('admin::product.product_group.create_produk_group',[
            'customer_group'      => $cg,
            'style'               => $this->user->group->style
        ]);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);

        $pgr = new ProductGroupRule();
        $pgr = $pgr->setConnection($this->user->group->katalog)->find($id);
        $cg  = CustomerGroup::where('group_id', $this->user->group->id)->get();

        return view('admin::product.product_group.edit_produk_group',[
            'product_group_rules' => $pgr,
            'customer_group'      => $cg,
            'style'               => $this->user->group->style
        ]);
    }
}
