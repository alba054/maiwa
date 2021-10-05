<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Peternak;
use Illuminate\Http\Request;

class PeternakController extends Controller
{
    
    public function index()
    {
        //
        $data = Peternak::with(['desa','user'])
        ->orderBy('nama_peternak','ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'peternak' => $data,
            ], 201);
    }
    public function indexById($id)
    {
        //
        $data = $this->resultData($id);
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'peternak' => $data,
            ], 201);
    }

    public function store(Request $request)
    {
        //
        // return $request;

        $save = Peternak::create([
            'desa_id' => $request->desa_id,
            'user_id' => $request->user_id,
            'kode_peternak' => $request->kode_peternak,
            'nama_peternak' => $request->nama_peternak,
            'no_hp' => $request->no_hp,
            'tgl_lahir' => $request->tgl_lahir,
            'jumlah_anggota' =>$request->jumlah_anggota,
            'luas_lahan' => $request->luas_lahan,
            'kelompok' => $request->kelompok,
        
        ]);

        $data = $this->resultData($request->user_id);
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                'peternak' => $data,
        ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'peternak' => $data,
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
        $update = Peternak::find($id)->update([
            'desa_id' => $request->desa_id,
            'user_id' => $request->user_id,
            'kode_peternak' => $request->kode_peternak,
            'nama_peternak' => $request->nama_peternak,
            'no_hp' => $request->no_hp,
            'tgl_lahir' => $request->tgl_lahir,
            'jumlah_anggota' =>$request->jumlah_anggota,
            'luas_lahan' => $request->luas_lahan,
            'kelompok' => $request->kelompok,
        ]);

        $data = $this->resultData($request->user_id);
        if ($update) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'peternak' => $data,

            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'peternak' => $data,

            ], 204);
        }
    }

    public function destroy($id, $userId)
    {
        $delete = Peternak::find($id)->delete();
        $data = $this->resultData($userId);
         if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'peternak' => $data,
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'peternak' => $data,
                
            ], 204);
        }
    }

    public function resultData($userId)
    {
       return Peternak::with(['desa','user'])
        ->where('user_id', $userId)
        ->orderBy('nama_peternak','ASC')->get();
    }
}
