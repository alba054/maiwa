<?php

namespace App\Http\Controllers\api;

use App\Helper\Constcoba;
use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Notifikasi;
use App\Models\Panen;
use App\Models\Pendamping;
use App\Models\Perlakuan;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Upah;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class PanenController extends Controller
{
    public function index($userId)
    {
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
            
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;

            $data = Panen::with('sapi')
            ->where('pendamping_id', $pendampingId)
            ->latest()->get();
        }else{
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
        
            $data = Panen::with('sapi')
            ->where('tsr_id', $tsrId)
            ->latest()->get();
        } 
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'panen' => $data,
        ], 201);
    }
    public function store(Request $request)
    {
        //

        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');

        $sapi = Sapi::find($request->sapi_id);
        $peternak = Peternak::find($sapi->peternak_id);
       
        $image = $request->image;

        $imageName = $request->foto;

        if (!empty($image)) {
            // $image->store('public/produk_photo');
            $imageName = $this->handleImageIntervention($request->image);
        }

        $keterangan = count(Panen::where(['sapi_id' => $request->sapi_id, 'role' => '0'])->get()) + 1;

        $data = [
            'tanggal' => $today,
            'status' => $request->status,
            'keterangan' => $keterangan,
            'sapi_id' => $request->sapi_id,
            'peternak_id' => $peternak->id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id,
            'foto' => $imageName
        ];

        
            $upah = Upah::find(5);
                    Laporan::create([
                        'sapi_id' => $request->sapi_id,
                        'peternak_id' => $peternak->id,
                        'pendamping_id' => $peternak->pendamping_id,
                        'tsr_id' => $peternak->pendamping->tsr_id,
                        'tanggal' => $today, 
                        'perlakuan' => $upah->detail,
                        'upah' => $upah->price,
                        ]);
        

        // return $data;
        $save = $request->id == 0 ? Panen::create($data) : Panen::find($request->id)->update($data);
        if ($save) {

            $notifikasi = Notifikasi::find($request->notifikasi_id);
            if ($notifikasi) {
                $notifikasi->update([
                    'status' => 'yes'
                ]);
            }

            $token = $sapi->peternak->pendamping->user->remember_token;
            // dd($token);
            // echo($token.'<br/>');
            $pesan = 'Terima Kasih, Telah melakukan Panen '.$sapi->eartag;

            Constcoba::sendFCM($token, 'MBC', $pesan, "0");

            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success !',
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                
            ], 204);
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
}
