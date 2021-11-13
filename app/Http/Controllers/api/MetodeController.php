<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Metode;
use Illuminate\Http\Request;

class MetodeController extends Controller
{
    public function index()
    {
        $data = Metode::orderBy('metode', 'ASC')->get();
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
            'metode' => $data,
        ], 201);
    }
}
