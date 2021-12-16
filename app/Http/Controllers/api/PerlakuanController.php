<?php

namespace App\Http\Controllers\api;

use App\Helper\Constcoba;
use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Notifikasi;
use App\Models\Pendamping;
use App\Models\Perlakuan;
use App\Models\Peternak;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Upah;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class PerlakuanController extends Controller
{
    public function index($userId)
    {
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
            
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;

            $data = Perlakuan::with(['sapi','obat','vitamin','vaksin','hormon'])
            ->where('pendamping_id', $pendampingId)
            ->latest()->get();
        }else if ($hak_akses == 2){
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
            

            $data = Perlakuan::with(['sapi','obat','vitamin','vaksin','hormon'])
            ->where('tsr_id', $tsrId)
            ->latest()->get();
        }else{
            $data = Perlakuan::with(['sapi','obat','vitamin','vaksin','hormon'])
            ->latest()->get();
        }
        
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'perlakuan' => $data,
        ], 201);
    }

    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');


        $image = $request->image;
        $imageName = $request->foto;

        $sapi = Sapi::find($request->sapi_id);
        $peternak = Peternak::find($sapi->peternak_id);


        if (!empty($image)) {
            // $image->store('public/produk_photo');
            $imageName = $this->handleImageIntervention($request->image);
        }
        $data = [
            'sapi_id' => $request->sapi_id,
            'tgl_perlakuan' => $today,
            'obat_id' => $request->obat_id,
            'dosis_obat' => $request->obat_dosis,
            'vaksin_id' => $request->vaksin_id,
            'dosis_vaksin' => $request->vaksin_dosis,
            'vitamin_id' => $request->vitamin_id,
            'dosis_vitamin' => $request->vitamin_dosis,
            'hormon_id' => $request->hormon_id,
            'dosis_hormon' => $request->hormon_dosis,
            'ket_perlakuan' => $request->ket_perlakuan,
            'peternak_id' => $peternak->id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id,
            'foto' => $imageName
        ];

        if ($request->id == 0) {
            $upah = Upah::find(4);
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

        $notifikasi = Notifikasi::find($request->notifikasi_id);
        if ($notifikasi) {
            $notifikasi->update([
                'status' => 'yes'
            ]);
        }

        $save = $request->id == 0 ? Perlakuan::create($data) : Perlakuan::find($request->id)->update($data);

        if ($save) {

            $token = $sapi->peternak->pendamping->user->remember_token;
            // dd($token);
            // echo($token.'<br/>');
            $pesan = 'Terima Kasih, Telah melakukan Perlakuan Kesehatan '.$sapi->eartag;

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
        $save = Perlakuan::find($id)->update([
            'sapi_id' => $request->sapi_id,
            'tgl_perlakuan' => $request->tgl,
            'jenis_obat' => $request->obat,
            'dosis_obat' => $request->obat_dosis,
            'vaksin' => $request->vaksin,
            'dosis_vaksin' => $request->vaksin_dosis,
            'vitamin' => $request->vitamin,
            'dosis_vitamin' => $request->vitamin_dosis,
            'hormon' => $request->hormon,
            'dosis_hormon' => $request->hormon_dosis,
            'ket_perlakuan' => $request->keterangan,
        ]);

        $data = Perlakuan::with('sapi')->latest()->get();
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'perlakuan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'perlakuan' => $data,
                
            ], 204);
        }
    }

    public function destroy($id)
    {
        $save = Perlakuan::find($id)->delete();

        $data = Perlakuan::with('sapi')->latest()->get();
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'perlakuan' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'perlakuan' => $data,
                
            ], 204);
        }
    }
}
