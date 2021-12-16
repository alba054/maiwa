<?php

namespace App\Http\Controllers\api;

use App\Helper\Constcoba;
use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Models\Sapi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BirahiController extends Controller
{
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");
        
        $result = $request->result;
        $notif_id = $request->notif_id;
        $notif = Notifikasi::find($notif_id);        
        $sapi = Sapi::find($notif->sapi_id);

        $token = $sapi->peternak->pendamping->user->remember_token;

        $keterangan = $notif->keterangan;
        $tanggal = $request->tanggal;

        // return $tanggal;

        $ketExp =  explode(",", $keterangan);
        // return $ketExp;
        // return Carbon::parse($tanggal)->adddays(21)->format('Y-m-d');

        if ($ketExp[0] <= "3") {
            
            if ($ketExp[0] == "0") {
        
                if ($result == "no") {
                    $pesan = 'Harap Kembali Melakukan Cek birahi keesokan hari pada sapi '.$sapi->eartag;
                    Constcoba::sendFCM($token, 'MBC', $pesan, "0");
    
                } else {
                    $notif->update([
                        'tanggal' => Carbon::parse($tanggal)->format('Y-m-d'),
                        'pesan' => "Cek Birahi Telah dilakukan",
                        'status' => "yes"
                    ]);

                    $this->createNotif($notif->sapi_id, "Cek Birahi", "0", "1,1", Carbon::parse($tanggal)->adddays(19)->format('Y-m-d') );
                    $pesan = 'Harap Kembali Melakukan Cek birahi 21 hari kemudian pada sapi '.$sapi->eartag;
                    Constcoba::sendFCM($token, 'MBC', $pesan, "0");
                }
                
                
            } else {
                
                
                // $keterangan = $notif->keterangan+1;
                $ketExp =  explode(",", $keterangan);
                $ketIB = $ketExp[0];
                $ketFrek = $ketExp[1];

                if ($result == "yes") {
                    $keterangan = $ketFrek + 1;

                    $this->createNotif($notif->sapi_id, "Insiminasi Buatan", "3", $ketIB .','.$keterangan, Carbon::parse($tanggal)->format('Y-m-d') );
        
                    
                    $pesan = 'Insiminasi Buatan pada sapi '.$sapi->eartag;
                    Constcoba::sendFCM($token, 'MBC', $pesan, "3");
    
                    $notif->update([
                        'sapi_id' => $notif->sapi_id,
                        'tanggal' => Carbon::parse($tanggal)->format('Y-m-d'),
                        'pesan' => "Cek Birahi Telah dilakukan",
                        'role' => "0",
                        'status' => "yes"
                    ]);
                }else {
                    if ($ketFrek < 3) {
                        $keterangan = $ketFrek + 1;
                        $notif->update([
                            'sapi_id' => $notif->sapi_id,
                            'tanggal' => Carbon::parse($tanggal)->adddays(1)->format('Y-m-d'),
                            'pesan' => "Cek Birahi",
                            'keterangan' => $ketIB .','.$keterangan,
                            'role' => "0"
                        ]);
        
                        $token = $sapi->peternak->pendamping->user->remember_token;
                    
                        $pesan = 'Harap Kembali Melakukan Cek birahi keesokan hari pada sapi '.$sapi->eartag;
                        Constcoba::sendFCM($token, 'MBC', $pesan, "0");
                    }else {
                        $this->createNotif($notif->sapi_id, "Periksa Kebuntingan", "1", "0,0", Carbon::parse($tanggal)->adddays(69)->format('Y-m-d') );
        
                        $token = $sapi->peternak->pendamping->user->remember_token;
                    
                        $pesan = 'Periksa Kebuntingan pada sapi '.$sapi->eartag;
                        Constcoba::sendFCM($token, 'MBC', $pesan, "1");
        
        
                        $notif->update([
                            'sapi_id' => $notif->sapi_id,
                            'tanggal' => Carbon::parse($tanggal)->format('Y-m-d'),
                            'pesan' => "Cek Birahi Telah dilakukan",
                            'role' => "0",
                            'status' => "yes"
                        ]);
                    }
                }
                
    
            }

        } else {

            $notif->update([
                'sapi_id' => $notif->sapi_id,
                'tanggal' => Carbon::parse($tanggal)->format('Y-m-d'),
                'pesan' => "Cek Birahi Telah dilakukan",
                'role' => "0",
                'status' => "yes"
            ]);
            
            $pesan = 'Harap Segera Menghubungi Dokter sapi '.$sapi->eartag;
            Constcoba::sendFCM($token, 'MBC', $pesan, "10");
            $this->createNotif($notif->sapi_id, "Segera Hubungi Dokter", "10", "0", Carbon::parse($tanggal)->format('Y-m-d') );
            $this->createNotif($notif->sapi_id, "Cek Birahi", "0", "0.0", Carbon::parse($tanggal)->adddays(1)->format('Y-m-d') );

        }
        
        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'success',
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


