<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Proses;
use DB;

class ProsesController extends Controller
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
        $proses = Proses::find($id);
        $proses->delete();
        $this->successStatus = 200;
        $success['success'] = true;
        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request)
    {
        $proses = new Proses();
        $proses = $proses->setConnection($this->user->group->katalog);
        $proses->nama_proses      = $request->nama_proses;
        $proses->deskripsi_proses = $request->deskripsi_proses;
        $proses->save();

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $proses;

        return response()->json($success, $this->successStatus);
    }
}
