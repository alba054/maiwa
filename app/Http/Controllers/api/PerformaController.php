<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pendamping;
use App\Models\Performa;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Upah;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class PerformaController extends Controller
{
    
    
    public function index($userId)
    {
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
            
            
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;

            $data = Performa::with('sapi')
            ->where('pendamping_id', $pendampingId)
            ->latest()->get();
        }else{
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
        
            $data = Performa::with('sapi')
            ->where('tsr_id', $tsrId)
            ->latest()->get();
        }
        
        
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'performa' => $data,
        ], 201);
    }

    
    public function store(Request $request)
    {
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
            'tanggal_performa' => $today,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'panjang_badan' => $request->panjang_badan,
            'lingkar_dada' => $request->lingkar_dada,
            'bsc' => $request->bsc,
            'sapi_id' => $request->sapi_id,
            'peternak_id' => $peternak->id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id,
            'foto' => $imageName
        ];

        if ($request->id == 0) {
            $upah = Upah::find(2);
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

       
        $save = $request->id == 0 ? Performa::create($data) : Performa::find($request->id)->update($data);
        
        if ($save) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Created !',
                
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
        $update = Performa::find($id)->update([
            'tanggal_performa' => $request->tanggal,
            'tinggi_badan' => $request->tinggi,
            'berat_badan' => $request->berat,
            'panjang_badan' => $request->panjang,
            'lingkar_dada' => $request->lingkar,
            'bsc' => $request->bsc,
            'sapi_id' => $request->sapiId,
        ]);
        $data = Performa::with('sapi')->latest()->get();
        if ($update) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Updated !',
                'performa' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'performa' => $data,
                
            ], 204);
        }
    }

   
    public function destroy($id)
    {
        $delete = Performa::find($id)->delete();
        $data = Performa::with('sapi')->latest()->get();
        if ($delete) {
            return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Deleted !',
                'performa' => $data,
            ], 201);

        } else {
            return response()->json([
                'responsecode' => '0',
                'responsemsg' => 'Something Wrong',
                'performa' => $data,
                
            ], 204);
        }
    }

    public function isSuccess($msg)
    {
        $this->alert('success', $msg, [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  '', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  false, 
            'showConfirmButton' =>  false, 
      ]);
    }
}
