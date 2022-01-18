<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Pendamping;
use App\Models\Tsr;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index($userId)
    {
        date_default_timezone_set("Asia/Makassar");
        // $this->createNotif(3, "Cek Birahi", "0", "0", Carbon::now()->adddays(69)->format('Y-m-d') );
        // $this->createNotif(3, "Periksa Kebuntingan", "1", "0", Carbon::now()->adddays(69)->format('Y-m-d') );
        // $this->createNotif(3, "Recording/Performa", "2", "0", Carbon::now()->adddays(69)->format('Y-m-d') );
        // $this->createNotif(3, "Insiminasi Buatan", "3", "0", Carbon::now()->adddays(69)->format('Y-m-d') );
        // $this->createNotif(3, "Berikan Vitamin, Obat, Vaksin, Hormon", "4", "0", Carbon::now()->adddays(69)->format('Y-m-d') );
        // $this->createNotif(3, "Panen", "5", "0", Carbon::now()->adddays(69)->format('Y-m-d') );
        // $this->createNotif(3, "Cek Kelahiran", "6", "0", Carbon::now()->adddays(69)->format('Y-m-d') );

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
            ->where('tanggal', '>=', now()->subdays(30)->format('Y-m-d'))
            // ->where('status', 'no')
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
            ->where('tanggal', '>=', now()->subdays(30)->format('Y-m-d'))

            // ->where('status', 'no')
            ->get();
        }else {
        
            $data = Notifikasi::with(['sapi'])
            ->orderBy('tanggal', 'ASC')
            ->where('tanggal', '>=', now()->subdays(30)->format('Y-m-d'))
            // ->where('status', 'no')
            ->get();
        }

        $dataFilter = [];
        foreach ($data as $key => $value) {
            
                array_push($dataFilter, $value);
            
        }
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'notifikasi' => $dataFilter,
        ], 201);
    }

    public function createNotif($sapi_id, $pesan, $role, $keterangan, $tanggal)
    {
        Notifikasi::create([
            'sapi_id' => $sapi_id,
            'tanggal' => $tanggal,
            'pesan' => $pesan,
            'keterangan' => $keterangan,
            'role' => $role
        ]);
    }
}
