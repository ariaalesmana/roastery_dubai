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

class SubSubCategoryController extends LayoutController {
    function __construct() {
        $this->middleware('permission:administrator', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $susubbcategories = Crypt::decryptString($hash);
        if($susubbcategories == 'subsubcategory')
        $subsubcategory = new Category();
        $subsubcategory = $subsubcategory->setConnection($this->user->group->katalog)->where('level', 4)->paginate(10);
        return view('admin::category.subsubcategory.subsubkategori', [
            'subsubcategory' => $subsubcategory, 
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function show(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        $subsubcategories = new Category();
        $subsubcategories = $subsubcategories->setConnection($this->user->group->katalog);
        $subsubcategory = $subsubcategories->find($id);
        $category = $subsubcategories->where('level', 2)->get();
        $subcategory = $subsubcategories->where('level', 3)->get();
        $relation_product = $subsubcategory->category_product()->whereHas('product')->paginate(10);
        return view('admin::category.subsubcategory.detail_subsubkategori',[
            'category' => $category,
            'subcategory' => $subcategory,
            'subsubcategory' => $subsubcategory,
            'relation_product' => $relation_product,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        $subsubcategories = new Category();
        $subsubcategories = $subsubcategories->setConnection($this->user->group->katalog);
        $subsubcategory = $subsubcategories->find($id);
        $category = $subsubcategories->where('level', 2)->get();
        $subcategory = $subsubcategories->where('level', 3)->get();
        $relation_product = $subsubcategory->category_product()->whereHas('product')->paginate(10);
        return view('admin::category.subsubcategory.edit_subsubkategori',[
            'category' => $category,
            'subcategory' => $subcategory,
            'subsubcategory' => $subsubcategory,
            'relation_product' => $relation_product,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
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
