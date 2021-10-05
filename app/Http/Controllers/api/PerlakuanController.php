<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Perlakuan;
use Illuminate\Http\Request;

class PerlakuanController extends Controller
{
    public function index()
    {
        $data = Perlakuan::with('sapi')->latest()->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'perlakuan' => $data,
        ], 201);
    }

    public function store(Request $request)
    {
        $save = Perlakuan::create([
            'sapi_id' => $request->sapi_id,
            'tgl_perlakuan' => $request->tgl,
            'jenis_obat' => $request->obat,
            'dosis_obat' => $request->obat_dosis,
            'vaksin' => $request->vaksin,
            'dosis_vaksin' => $request->vaksin_dosis,
            'vitamin' => $request->vitamin,
            'dosis_vitamin' => $request->vitamin_dosis,
            'hormon' => $request->hormon,
            'dosis_hormon' => $request->hormon_dosis,
            'ket_perlakuan' => $request->keterangan,
        ]);

        $data = Perlakuan::with('sapi')->latest()->get();
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                'perlakuan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'perlakuan' => $data,
                
            ], 204);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $save = Perlakuan::find($id)->update([
            'sapi_id' => $request->sapi_id,
            'tgl_perlakuan' => $request->tgl,
            'jenis_obat' => $request->obat,
            'dosis_obat' => $request->obat_dosis,
            'vaksin' => $request->vaksin,
            'dosis_vaksin' => $request->vaksin_dosis,
            'vitamin' => $request->vitamin,
            'dosis_vitamin' => $request->vitamin_dosis,
            'hormon' => $request->hormon,
            'dosis_hormon' => $request->hormon_dosis,
            'ket_perlakuan' => $request->keterangan,
        ]);

        $data = Perlakuan::with('sapi')->latest()->get();
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'perlakuan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'perlakuan' => $data,
                
            ], 204);
        }
    }

    public function destroy($id)
    {
        $save = Perlakuan::find($id)->delete();

        $data = Perlakuan::with('sapi')->latest()->get();
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'perlakuan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'perlakuan' => $data,
                
            ], 204);
        }
    }
}
