<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Hormon;
use App\Models\Obat;
use App\Models\Vaksin;
use App\Models\Vitamin;
use Illuminate\Http\Request;

class MasterPerlakuanController extends Controller
{
    public function obat()
    {
        $data = Obat::orderBy('name', 'ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'obat' => $data,
        ], 201);
    }
    public function vitamin()
    {
        $data = Vitamin::orderBy('name', 'ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'vitamin' => $data,
        ], 201);
    }
    public function vaksin()
    {
        $data = Vaksin::orderBy('name', 'ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'vaksin' => $data,
        ], 201);
    }
    public function hormon()
    {
        $data = Hormon::orderBy('name', 'ASC')->get();
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'hormon' => $data,
        ], 201);
    }
}
