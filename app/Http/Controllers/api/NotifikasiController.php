<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index($id)
    {
        $data = Notifikasi::allnotif($id);
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'notifikasi' => $data,
        ], 201);
    }
}
