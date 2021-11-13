<?php

namespace App\Http\Controllers\api;

use App\Helper\Constcoba;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Sapi;
use Illuminate\Http\Request;

class BirahiController extends Controller
{
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");
        
        $result = $request->result;
        $notif_id = $request->notif_id;
        $notif = Notifikasi::find($notif_id);

        
        $keterangan = $notif->keterangan+1;
        $sapi = Sapi::find($notif->sapi_id);

        
        if ($notif->keterangan < 3) {
            if ($result == "yes") {
               
               
                $this->createNotif($notif->sapi_id, "Insiminasi Buatan", "3", $keterangan );

                $token = $sapi->peternak->pendamping->user->remember_token;
            
                $pesan = 'Insiminasi Buatan pada sapi '.$sapi->eartag;
                Constcoba::sendFCM($token, 'MBC', $pesan, "3");


                $notif->update([
                    'sapi_id' => $notif->sapi_id,
                    'tanggal' => now()->format('Y-m-d'),
                    'pesan' => "Cek Birahi Telah dilakukan",
                    'keterangan' => $keterangan,
                    'role' => "0",
                    'status' => "yes"
                ]);

            }else{

                $notif->update([
                    'sapi_id' => $notif->sapi_id,
                    'tanggal' => now()->adddays(1)->format('Y-m-d'),
                    'pesan' => "Cek Birahi",
                    'keterangan' => $keterangan,
                    'role' => "0"
                ]);

                $token = $sapi->peternak->pendamping->user->remember_token;
            
                $pesan = 'Harap Kembali Melakukan Cek birahi keesokan hari pada sapi '.$sapi->eartag;
                Constcoba::sendFCM($token, 'MBC', $pesan, "3");

            }
        }else{
            if ($result == "yes") {
                
                $keterangan = $notif->keterangan+1;
                
                $this->createNotif($notif->sapi_id, "Insiminasi Buatan", "3", $keterangan );

                $token = $sapi->peternak->pendamping->user->remember_token;
            
                $pesan = 'Harap segera Melakukan Insiminasi Buatan pada sapi '.$sapi->eartag;
                Constcoba::sendFCM($token, 'MBC', $pesan, "3");


                $notif->update([
                    'sapi_id' => $notif->sapi_id,
                    'tanggal' => now()->format('Y-m-d'),
                    'pesan' => "Cek Birahi Telah dilakukan",
                    'keterangan' => $keterangan,
                    'role' => "0",
                    'status' => "yes"
                ]);

            } else {
            

                $this->createNotif($notif->sapi_id, "Periksa Kebuntingan", "1", $keterangan );

                $token = $sapi->peternak->pendamping->user->remember_token;
            
                $pesan = 'Periksa Kebuntingan pada sapi '.$sapi->eartag;
                Constcoba::sendFCM($token, 'MBC', $pesan, "1");


                $notif->update([
                    'sapi_id' => $notif->sapi_id,
                    'tanggal' => now()->format('Y-m-d'),
                    'pesan' => "Cek Birahi Telah dilakukan",
                    'keterangan' => $notif->keterangan+1,
                    'role' => "0",
                    'status' => "yes"
                ]);

            }
        }

        return response()->json([
            'responsecode' => '0',
            'responsemsg' => 'success',
        ], 201);
        
        
    }

    public function createNotif($sapi_id, $pesan, $role, $keterangan)
    {
        Notifikasi::create([
            'sapi_id' => $sapi_id,
            'tanggal' => now()->format('Y-m-d'),
            'pesan' => $pesan,
            'keterangan' => $keterangan,
            'role' => $role
        ]);
    }
}


