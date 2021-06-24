<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Unit;
use DB;

class UnitController extends Controller
{
    public $successStatus = 401;

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function get_unit_detail(Request $request)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success']  = true;
        $success['unit'] = Unit::all();

        return response()->json($success, $this->successStatus);
    }

    public function delete(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $unit = Unit::find($id);
        $unit->delete();
        $this->successStatus = 200;
        $success['success'] = true;
        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request)
    {
        $unit = new Unit();
        $unit = $unit->setConnection($this->user->group->katalog);
        $unit->nama_unit      = $request->nama_unit;
        $unit->save();

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $unit;

        return response()->json($success, $this->successStatus);
    }
}
