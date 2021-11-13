<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Hasil;
use Illuminate\Http\Request;

class HasilController extends Controller
{
   public function index()
   {
    $data = Hasil::orderBy('hasil', 'ASC')->get();
    return response()->json([
        'responsecode' => '1',
        'responsemsg' => 'Success',
        'hasil' => $data,
    ], 201);
   }
}
