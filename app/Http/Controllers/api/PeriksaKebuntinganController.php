<?php

namespace App\Http\Controllers\api;

use App\Helper\Constcoba;
use App\Http\Controllers\Controller;
use App\Models\Hasil;
use App\Models\Laporan;
use App\Models\Notifikasi;
use App\Models\Pendamping;
use App\Models\PeriksaKebuntingan;
use App\Models\Peternak;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Upah;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class PeriksaKebuntinganController extends Controller
{
    
    public function index($userId)
    {
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
            
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;
        // return $pendampingId;
            $data = PeriksaKebuntingan::with(['sapi','hasil','metode'])
            ->where('pendamping_id', $pendampingId)
            ->latest()->get();
        }else if ($hak_akses == 2) {
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
        // return $pendampingId;
            $data = PeriksaKebuntingan::with(['sapi','hasil','metode'])
            ->where('tsr_id', $tsrId)
            ->latest()->get();
        }else {
        
            $data = PeriksaKebuntingan::with(['sapi','hasil','metode'])
            ->latest()->get();
        }
        
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'periksa_kebuntingan' => $data,
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

        $data = [
            'waktu_pk' => $today,
            'metode_id' => $request->metode_id,
            'status' => $request->status,
            'reproduksi' => $request->reproduksi,
            'hasil_id' => $request->hasil_id,
            'sapi_id' => $request->sapi_id,
            'peternak_id' => $peternak->id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id,
            'foto' => $imageName
        ];

        if ($request->id == 0) {
            $upah = Upah::find(1);
                    Laporan::create([
                        'sapi_id' => $request->sapi_id,
                        'peternak_id' => $peternak->id,
                        'pendamping_id' => $peternak->pendamping_id,
                        'tsr_id' => $peternak->pendamping->tsr_id,
                        'tanggal' => $today, 
                        'perlakuan' => $upah->detail,
                        'upah' => $upah->price,
                        ]);
        }

        // return $data;
        $save = $request->id == 0 ? PeriksaKebuntingan::create($data) : PeriksaKebuntingan::find($request->id)->update($data);
        if ($save) {

            $token = $sapi->peternak->pendamping->user->remember_token;

            $pesan = 'Terima Kasih, Telah melakukan Periksa Kebuntingan '.$sapi->eartag;
            Constcoba::sendFCM($token, 'MBC', $pesan, "0");

            $notifikasi = Notifikasi::find($request->notifikasi_id);
            $hasil = Hasil::find($request->hasil_id);

            if ($notifikasi) {
                $notifikasi->update([
                    'status' => 'yes',
                    'pesan' => 'Cek Birahi Telah Dilakukan'
                ]);
            }

            if ($hasil->hasil == "Bunting") {
                Notifikasi::create([
                    'sapi_id' => $request->sapi_id,
                    'tanggal' => now()->adddays(180)->format('Y-m-d'),
                    'pesan' => "Cek Kelahiran",
                    'keterangan' => "0,0",
                    'role' => "10"
                ]);

                $pesan = "Enam Bulan Akan Melahirkan";
                Constcoba::sendFCM($token, 'MBC', $pesan, "10");

            } else {
                $pesan = 'Harap Segera Menghubungi Dokter sapi '.$sapi->eartag;
                Constcoba::sendFCM($token, 'MBC', $pesan, "10");

                Notifikasi::create([
                    'sapi_id' => $request->sapi_id,
                    'tanggal' => now()->format('Y-m-d'),
                    'pesan' => "Harap segera hubungi Dokter",
                    'keterangan' => "0,0",
                    'role' => "10"
                ]);
            }
            

            // dd($token);
            // echo($token.'<br/>');
            

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

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
        $update = PeriksaKebuntingan::find($id)->update([
            'waktu_pk' => $request->waktu_pk,
            'metode' => $request->metode,
            'hasil' => $request->hasil,
            'sapi_id' => $request->sapi_id,
        ]);

       
        $data = PeriksaKebuntingan::with('sapi')->latest()->get();

        if ($update) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'periksa_kebuntingan' => $data,
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'periksa_kebuntingan' => $data,
                
            ], 204);
        }
    }

    public function destroy($id, $userId)
    {
        $delete = PeriksaKebuntingan::find($id)->delete();

        $pendampingId = Pendamping::where('user_id', $userId)->first()->id;
        // return $pendampingId;
        $data = PeriksaKebuntingan::with(['sapi','hasil','metode'])
        ->where('pendamping_id', $pendampingId)
        ->latest()->get();
       
        if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'periksa_kebuntingan' => $data,
                
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'periksa_kebuntingan' => $data,
                
            ], 204);
        }
    }
}
