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

class CategoryController extends LayoutController {
    function __construct() {
        $this->middleware('permission:administrator', ['only' => ['index']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index(Request $request, $code, $hash) {
        $categories = Crypt::decryptString($hash);

        if($categories == 'category')
        $category = new Category;
        $category = $category->setConnection($this->user->group->katalog)->where('level', 2)
        ->when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->keyword}%");
            });
        })
        ->paginate(10);
        $category->appends($request->only('keyword'));

        return view('admin::category.category.kategori', [
            'category' => $category, 
            'style'    => $this->user->group->style,
            'keyword'  => $request->keyword
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create(Request $request, $code, $hash) {
        $categories = Crypt::decryptString($hash);

        if($categories == 'category')
        return view('admin::category.category.create', [
            'style'    => $this->user->group->style
        ]);
    }

    public function create_post(Request $request, $code) {
        $this->validateForm($request, 'create');
        echo json_encode($request->all());
    }

    public function edit(Request $request, $code, $hash) {
        $id = Crypt::decryptString($hash);
        $category = new Category();
        $category = $category->setConnection($this->user->group->katalog)->find($id);
        $relation_product = $category->category_product()->whereHas('product')->paginate(10);
        return view('admin::category.category.edit_kategori',[
            'category' => $category,
            'relation_product' => $relation_product,
            'style' => $this->user->group->style
        ])
        ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function validateForm($request, $type) {
        $messages = [
            'name.required'            => 'Nama kategori wajib diisi !',
            'status_category.required' => 'Status wajib diisi !'
        ];
        $this->validate($request,[
            'name'            => 'required',
            'status_category' => 'required'
        ],$messages);

        if($type == 'create') {
            return view('admin::category.category.create', [
                'data' => $request
            ]);
        } else if($type == 'edit') {
            return view('admin::category.category.edit_kategori', [
                'data' => $request
            ]);
        }
    }
}
