<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PeriksaKebuntingan;
use Illuminate\Http\Request;

class PeriksaKebuntinganController extends Controller
{
    
    public function index()
    {
        //
        $data = PeriksaKebuntingan::with('sapi')->latest()->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'periksa_kebuntingan' => $data,
            ], 201);
    }

    public function store(Request $request)
    {
        //
        $save = PeriksaKebuntingan::create([
            'waktu_pk' => $request->waktu_pk,
            'metode' => $request->metode,
            'hasil' => $request->hasil,
            'sapi_id' => $request->sapi_id,
        ]);

        $data = PeriksaKebuntingan::with('sapi')->latest()->get();

       
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                'periksa_kebuntingan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'periksa_kebuntingan' => $data,
                
            ], 204);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $update = PeriksaKebuntingan::find($id)->update([
            'waktu_pk' => $request->waktu_pk,
            'metode' => $request->metode,
            'hasil' => $request->hasil,
            'sapi_id' => $request->sapi_id,
        ]);

       
        $data = PeriksaKebuntingan::with('sapi')->latest()->get();

        if ($update) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'periksa_kebuntingan' => $data,
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'periksa_kebuntingan' => $data,
                
            ], 204);
        }
    }

    public function destroy($id)
    {
        $delete = PeriksaKebuntingan::find($id)->delete();

        $data = PeriksaKebuntingan::with('sapi')->latest()->get();
       
        if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'periksa_kebuntingan' => $data,
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'periksa_kebuntingan' => $data,
                
            ], 204);
        }
    }
}
