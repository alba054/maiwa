<?php

namespace App\Http\Controllers\api;

use App\Helper\Constcoba;
use App\Http\Controllers\Controller;
use App\Models\InsiminasiBuatan;
use App\Models\Laporan;
use App\Models\Notifikasi;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Upah;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class InsiminasiBuatanController extends Controller
{
   
    public function index($userId)
    {
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
            
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;
            $data = InsiminasiBuatan::with(['sapi','strow'])
            ->where('pendamping_id', $pendampingId)
            ->latest()->get();
        } else if ($hak_akses == 2) {
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
            $data = InsiminasiBuatan::with(['sapi','strow'])
            ->where('tsr_id', $tsrId)
            ->latest()->get();
        }else {
            $data = InsiminasiBuatan::with(['sapi','strow'])
            ->latest()->get();
        }
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'insiminasi_buatan' => $data,
            ], 201);
    }

    
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');
        
        $sapi = Sapi::find($request->sapi_id);
        $peternak = Peternak::find($sapi->peternak_id);


        $waktu_ib = $today;
        $strow_id = $request->strow_id;
        $sapi_id = $request->sapi_id;
        $image = $request->image;

        $imageName = $request->foto;

        if (!empty($image)) {
            $imageName = $this->handleImageIntervention($request->image);
        }

        $notifikasi = Notifikasi::find($request->notifikasi_id);
        $ketExp =  explode(",", $notifikasi->keterangan);
        $ketIB = $ketExp[0];
        $ketFrek = $ketExp[1];
        $dosis_ib = $ketIB;

        $data = [
            'waktu_ib' => $waktu_ib,
            'dosis_ib' => $dosis_ib,
            'strow_id' => $strow_id,
            'sapi_id' => $sapi_id,
            'peternak_id' => $peternak->id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id,
            'foto' => $imageName
        ];

        if ($request->id == 0) {
            $upah = Upah::find(3);
                    Laporan::create([
                        'sapi_id' => $sapi_id,
                        'peternak_id' => $peternak->id,
                        'pendamping_id' => $peternak->pendamping_id,
                        'tsr_id' => $peternak->pendamping->tsr_id,
                        'tanggal' => $today, 
                        'perlakuan' => $upah->detail,
                        'upah' => $upah->price,
                        ]);
        }

        $save = $request->id == 0 ? InsiminasiBuatan::create($data) : InsiminasiBuatan::find($request->id)->update($data);


        if ($save) {
            $token = $sapi->peternak->pendamping->user->remember_token;
            // dd($token);
            // echo($token.'<br/>');

            
            if ($notifikasi) {
                $notifikasi->update([
                    'status' => 'yes',
                    'pesan' => "Cek Birahi Telah Dilakukan",
                ]);
            }

            Notifikasi::create([
                'sapi_id' => $sapi_id,
                'tanggal' => now()->adddays(21)->format('Y-m-d'),
                'pesan' => "Cek Birahi",
                'keterangan' => $ketIB + 1 .',1',
                'role' => "0"
            ]);

            $pesan = 'Terima Kasih, Telah melakukan Insiminasi Buatan '.$sapi->eartag;

            Constcoba::sendFCM($token, 'MBC', $pesan, "0");
            
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
            ], 201);
        }
    }

    public function handleImageIntervention($res_foto)
    {
        $res_foto->store('public/photos');
        $imageName = $res_foto->hashName();
        $data['foto'] = $imageName;

        $manager = new ImageManager();
        $image = $manager->make('storage/photos/'.$imageName)->resize(500,300);
        $image->save('storage/photos_thumb/'.$imageName);

        return $imageName;
    }

    
    public function show($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $save = InsiminasiBuatan::find($id)->update([
            'waktu_ib' => $request->waktu,
            'dosis_ib' => $request->dosis,
            'strow_id' => $request->strowId,
            'sapi_id' => $request->sapiId,
        ]);

        $data = InsiminasiBuatan::with(['sapi','strow'])->latest()->get();
        
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'insiminasi_buatan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'insiminasi_buatan' => $data,
                
            ], 204);
        }
    }

   
    public function destroy($id)
    {
        $delete = InsiminasiBuatan::find($id)->delete();

        $data = InsiminasiBuatan::with(['sapi','strow'])->latest()->get();
        
        if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'insiminasi_buatan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'insiminasi_buatan' => $data,
                
            ], 204);
        }
    }
}
