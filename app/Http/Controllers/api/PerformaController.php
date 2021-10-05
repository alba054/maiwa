<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Performa;
use Illuminate\Http\Request;

class PerformaController extends Controller
{
    
    public function index()
    {
        $data = Performa::with('sapi')->latest()->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'performa' => $data,
        ], 201);
    }

    
    public function store(Request $request)
    {
        $save = Performa::create([
            'tanggal_performa' => $request->tanggal,
            'tinggi_badan' => $request->tinggi,
            'berat_badan' => $request->berat,
            'panjang_badan' => $request->panjang,
            'lingkar_dada' => $request->lingkar,
            'bsc' => $request->bsc,
            'sapi_id' => $request->sapiId,
        ]);
        $data = Performa::with('sapi')->latest()->get();
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
        $update = Performa::find($id)->update([
            'tanggal_performa' => $request->tanggal,
            'tinggi_badan' => $request->tinggi,
            'berat_badan' => $request->berat,
            'panjang_badan' => $request->panjang,
            'lingkar_dada' => $request->lingkar,
            'bsc' => $request->bsc,
            'sapi_id' => $request->sapiId,
        ]);
        $data = Performa::with('sapi')->latest()->get();
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
        $delete = Performa::find($id)->delete();
        $data = Performa::with('sapi')->latest()->get();
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
