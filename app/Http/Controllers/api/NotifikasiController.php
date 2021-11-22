<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Pendamping;
use App\Models\Tsr;
use App\Models\User;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index($userId)
    {
        date_default_timezone_set("Asia/Makassar");
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
            
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;
        
            $data = Notifikasi::with(['sapi'])
            ->orderBy('tanggal', 'ASC')
            ->whereHas('sapi.peternak', function($q) use($pendampingId) {
            
                if($pendampingId != null){
                    $q->where('pendamping_id', $pendampingId);
                }
                
            })
            // ->WhereBetween('tanggal', [now()->subdays(7)->format('Y-m-d'), now()->format('Y-m-d')])
            // ->where('tanggal', '<=', now()->format('Y-m-d'))
            // ->where('status', 'no')
            ->get();
        }else{
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
        
            $data = Notifikasi::with(['sapi'])
            ->orderBy('tanggal', 'ASC')
            ->where('tsr_id',$tsrId)
            // ->where('tanggal', '<=', now()->format('Y-m-d'))
            // ->WhereBetween('tanggal', [now()->subdays(7)->format('Y-m-d'), now()->format('Y-m-d')])
            // ->where('status', 'no')
            ->get();
        }
        
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'notifikasi' => $data,
        ], 201);
    }
}
