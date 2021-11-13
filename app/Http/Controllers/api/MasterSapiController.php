<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\JenisSapi;
use App\Models\StatusSapi;
use Illuminate\Http\Request;

class MasterSapiController extends Controller
{
    public function index()
    {
        // return 'hahahah';
        $status_sapi = StatusSapi::orderBy('status')->get();
        $jenis_sapi = JenisSapi::orderBy('jenis')->get();


        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
            'jenis_sapi' => $jenis_sapi,
            'status_sapi' => $status_sapi,
    ], 201);
    }
}
