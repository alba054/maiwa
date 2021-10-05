<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Strow;
use Illuminate\Http\Request;

class StrowController extends Controller
{
    public function index()
    {
        $data = Strow::with('sapi')->orderBy('kode_batch', 'ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'strow' => $data,
        ], 201);

    }

    public function store(Request $request)
    {
        $save = Strow::create([
            'sapi_id' => $request->sapiId,
            'kode_batch' => $request->kode,
            'batch' => $request->batch,
        ]);

        $data = Strow::with('sapi')->orderBy('kode_batch', 'ASC')->get();
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                'performa' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'performa' => $data,
                
            ], 204);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $update = Strow::find($id)->update([
            'sapi_id' => $request->sapiId,
            'kode_batch' => $request->kode,
            'batch' => $request->batch,
        ]);
        
        $data = Strow::with('sapi')->orderBy('kode_batch', 'ASC')->get();
        if ($update) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'performa' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'performa' => $data,
                
            ], 204);
        }
    }

    public function destroy($id)
    {
        $delete = Strow::find($id)->delete();
        
        $data = Strow::with('sapi')->orderBy('kode_batch', 'ASC')->get();

        if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'performa' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'performa' => $data,
                
            ], 204);
        }
    }
}
