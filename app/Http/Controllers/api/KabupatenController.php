<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    //
    public function kabupaten()
    {
        $data = Kabupaten::with('kecamatans')->orderBy('name','ASC')->get();

        $desa = Desa::with('kecamatan')->orderBy('kecamatan_id','ASC')->get();
        $kecamatan = Kecamatan::with(['kabupaten','desas'])->orderBy('kabupaten_id','ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'kabupaten' => $data,
            ], 201);
    }
}
