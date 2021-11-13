<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pendamping;
use App\Models\Tsr;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
   public function index($userId)
   {
      $data = [];
      $hak_akses = User::find($userId)->hak_akses;
      if ($hak_akses == 3) {
          
         $pendampingId = Pendamping::where('user_id', $userId)->first()->id;
         $data = Laporan::where('pendamping_id', $pendampingId)->latest()->get();
      }else{
          $tsrId = Tsr::where('user_id', $userId)->first()->id;
          $data = Laporan::where('tsr_id', $tsrId)->latest()->get();
      }
      
        
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
            'laporan' => $data,
    ], 201);

   }
}
