<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Batch;
use App\Biji;
use App\Jenis;
use App\Proses;
use App\Supplier;
use DB;

class BatchController extends Controller
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
        $success['batch']   = Batch::orderBy('created_at', 'desc')->get();;

        return response()->json($success, $this->successStatus);
    }

    public function detail(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success'] = true;
        $success['batch']   = Batch::find($id);

        return response()->json($success, $this->successStatus);
    }

    public function add_detail(Request $request)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $this->successStatus = 200;
        $success['success']  = true;
        $success['biji']     = Biji::all();
        $success['jenis']    = Jenis::all();
        $success['proses']   = Proses::all();
        $success['supplier'] = Supplier::all();

        return response()->json($success, $this->successStatus);
    }

    public function delete(Request $request, $id)
    {
        DB::setDefaultConnection($this->user->group()->first()->katalog);
        $batch = Batch::find($id);
        $batch->delete();
        $this->successStatus = 200;
        $success['success'] = true;
        return response()->json($success, $this->successStatus);
    }

    public function add(Request $request)
    {
        $raw = array(
            'batch_id'    => $request->batch_id,
            'jenis_id'    => $request->jenis_id,
            'proses_id'   => $request->proses_id,
            'supplier_id' => $request->supplier_id,
            'biji_id'     => $request->biji_id,
            'volume'      => $request->volume,
            'gambar'      => $request->gambar,
            'tgl_panen'   => $request->tgl_panen
        );
        $batch_id = hash('sha256', json_encode($raw));
        $batch              = new Batch();
        $batch              = $batch->setConnection($this->user->group->katalog);
        $batch->batch       = $batch_id;
        $batch->batch_id    = $request->batch_id;
        $batch->jenis_id    = $request->jenis_id;
        $batch->proses_id   = $request->proses_id;
        $batch->supplier_id = $request->supplier_id;
        $batch->biji_id     = $request->biji_id;
        $batch->volume      = $request->volume;
        if ($request->hasFile('files')) {
            $files          = $request->file('files');
            $files->move(public_path("images/batch/") . $request->batch_id . '/', $request->fileName);
            $batch->gambar  = $request->fileName;
            $batch->path    = "images/batch/" . $batch_id . '/' . $request->fileName;
            $batch->ext     = $files->getClientOriginalExtension();
        }
        $batch->tgl_panen   = date('Y-m-d', strtotime($request->tgl_panen));
        $batch->save();

        $this->successStatus = 200;
        $success['success']  = true;
        $success['data']     = $batch;

        return response()->json($request, $this->successStatus);
    }
}
