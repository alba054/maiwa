<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\InsiminasiBuatan;
use Illuminate\Http\Request;

class InsiminasiBuatanController extends Controller
{
   
    public function index()
    {
        $data = InsiminasiBuatan::with(['sapi','strow'])->latest()->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'insiminasi_buatan' => $data,
            ], 201);
    }

    
    public function store(Request $request)
    {
        $save = InsiminasiBuatan::create([
            'waktu_ib' => $request->waktu,
            'dosis_ib' => $request->dosis,
            'strow_id' => $request->strowId,
            'sapi_id' => $request->sapiId,
        ]);

        $data = InsiminasiBuatan::with(['sapi','strow'])->latest()->get();

        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                'insiminasi_buatan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'insiminasi_buatan' => $data,
                
            ], 204);
        }
    }

    
    public function show($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $save = InsiminasiBuatan::find($id)->update([
            'waktu_ib' => $request->waktu,
            'dosis_ib' => $request->dosis,
            'strow_id' => $request->strowId,
            'sapi_id' => $request->sapiId,
        ]);

        $data = InsiminasiBuatan::with(['sapi','strow'])->latest()->get();
        
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'insiminasi_buatan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'insiminasi_buatan' => $data,
                
            ], 204);
        }
    }

   
    public function destroy($id)
    {
        $delete = InsiminasiBuatan::find($id)->delete();

        $data = InsiminasiBuatan::with(['sapi','strow'])->latest()->get();
        
        if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'insiminasi_buatan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'insiminasi_buatan' => $data,
                
            ], 204);
        }
    }
}
