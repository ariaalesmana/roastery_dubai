<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Supplier;
use DB;

class SupplierController extends Controller
{
    public $successStatus = 401;

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;
        $success['supplier']   = Supplier::all();

        return response()->json($success, $this->successStatus);
    }

    public function detail(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;
        $success['supplier']   = Supplier::find($id);

        return response()->json($success, $this->successStatus);
    }

    public function delete(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $supplier = Supplier::find($id);
        $supplier->delete();
        $this->successStatus = 200;
        $success['success'] = true;
        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request)
    {
        $supplier = new Supplier();
        $supplier = $supplier->setConnection($this->user->group->katalog);
        $supplier->nama_supplier      = $request->nama_supplier;
        $supplier->lokasi_supplier = $request->lokasi_supplier;
        $supplier->save();

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $supplier;

        return response()->json($success, $this->successStatus);
    }
}
