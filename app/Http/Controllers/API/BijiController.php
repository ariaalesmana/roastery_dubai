<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Biji;
use DB;

class BijiController extends Controller
{
    public $successStatus = 401;

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function delete(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $biji = Biji::find($id);
        $biji->delete();
        $this->successStatus = 200;
        $success['success'] = true;
        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request)
    {
        $bijis = new Biji();
        $bijis = $bijis->setConnection($this->user->group->katalog);
        $bijis->nama_biji      = $request->nama_biji;
        $bijis->deskripsi_biji = $request->deskripsi_biji;
        $bijis->save();

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $bijis;

        return response()->json($success, $this->successStatus);
    }
}
