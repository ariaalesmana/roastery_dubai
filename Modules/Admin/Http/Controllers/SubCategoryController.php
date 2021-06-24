<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Admin\Http\Controllers\LayoutController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use App\Category\Category;
use Illuminate\Support\Facades\Crypt;

class SubCategoryController extends LayoutController {
    function __construct() {
        $this->middleware('permission:administrator', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $subcategories = Crypt::decryptString($hash);
        if($subcategories == 'subcategory')
        $subcategory = new Category();
        $subcategory = $subcategory->setConnection($this->user->group->katalog)->where('level', 3)->paginate(10);
        return view('admin::category.subcategory.subkategori', [
            'subcategory' => $subcategory, 
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        $subcategories = new Category();
        $subcategories = $subcategories->setConnection($this->user->group->katalog);
        $subcategory = $subcategories->find($id);
        $category = $subcategories->where('level', 2)->get();
        $relation_product = $subcategory->category_product()->whereHas('product')->paginate(10);
        return view('admin::category.subcategory.detail_subkategori',[
            'category' => $category,
            'subcategory' => $subcategory,
            'relation_product' => $relation_product,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        $subcategories = new Category();
        $subcategories = $subcategories->setConnection($this->user->group->katalog);
        $subcategory = $subcategories->find($id);
        $category = $subcategories->where('level', 2)->get();
        $relation_product = $subcategory->category_product()->whereHas('product')->paginate(10);
        return view('admin::category.subcategory.edit_subkategori',[
            'category' => $category,
            'subcategory' => $subcategory,
            'relation_product' => $relation_product,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function get_sub_category_by_parent(Request $request) {
        $subcategories = new Category();
        $subcategories = $subcategories->setConnection($this->user->group->katalog);
        $subcategory = $subcategories->where('parent_id', $request->category_id)->get();
        return response()->json($subcategory, 200);
    }

    public function search(Request $request, $code) {
        DB::setDefaultConnection(group::where('code', $code)->first()->katalog);
        $subcategory = Category::where('name', 'like', '%' .$request->q. '%')
            ->orderBy('name', 'asc');
        return view('admin::category.subcategory.index',[
            'subcategory' => $subcategory->paginate(10), 
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }
}
