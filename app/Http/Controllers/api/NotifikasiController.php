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
            // ->WhereBetween('tanggal', [now()->subdays(7)->format('Y-m-d'), now()->adddays(7)->format('Y-m-d')])
            ->where('tanggal', '>=', now()->subdays(7)->format('Y-m-d'))
            ->where('status', 'no')
            ->get();
        }else if ($hak_akses == 2){
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
        
            $data = Notifikasi::with(['sapi'])
            ->orderBy('tanggal', 'ASC')
            ->whereHas('sapi.peternak.pendamping', function($q) use($tsrId) {
            
                if($tsrId != null){
                    $q->where('tsr_id', $tsrId);
                }
                
            })
            // ->WhereBetween('tanggal', [now()->subdays(7)->format('Y-m-d'), now()->adddays(7)->format('Y-m-d')])
            ->where('tanggal', '>=', now()->subdays(7)->format('Y-m-d'))

            ->where('status', 'no')
            ->get();
        }else {
        
            $data = Notifikasi::with(['sapi'])
            ->orderBy('tanggal', 'ASC')
            
            ->where('tanggal', '>=', now()->subdays(7)->format('Y-m-d'))

            ->where('status', 'no')
            ->get();
        }
        
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'notifikasi' => $data,
        ], 201);
    }
}
