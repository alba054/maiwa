<?php

namespace App\Http\Controllers\api;

use App\Helper\Constcoba;
use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Notifikasi;
use App\Models\Pendamping;
use App\Models\Performa;
use App\Models\Peternak;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Upah;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class SapiController extends Controller
{
    protected $notif = array ();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
            
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;
            $data = Sapi::with(['jenis_sapi','status_sapi', 'peternak'])
            ->whereHas('peternak', function($q) use($pendampingId) {
            
                if($pendampingId != null){
                    $q->where('pendamping_id', $pendampingId);
                }
                
            })
            
            ->latest()->get();
        }else{
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
            $data = Sapi::with(['jenis_sapi','status_sapi'])
            ->where('tsr_id', $tsrId)
            ->latest()->get();
        }
        
       
        return response()->json([
                'responsecode' => '1',
                'responsemsg' => 'Success',
                'sapi' => $data,
            ], 201);

    }

    
    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Makassar");
        // $today = date('Y/m/d');

        $eartagInduk = $request->eartag_induk;
        $eartagIndukExplode = explode("-", $eartagInduk);


        $latestSapi = Sapi::latest()->first()->eartag;
        $eartagLastSapi = explode("-", $latestSapi);


        $noUniq =  $eartagLastSapi[3] +1 ;
        // return $noUniq;

        $subs = substr($eartagIndukExplode[1],1,1);
        $eartagBuilder = [
            'unik' => sprintf("%'03d", $noUniq),
            'induk' => $eartagIndukExplode[3],
            'generasi' => 'F'.$subs+1,
            // 'anak_ke' =>$request->anak_ke
        ];

        $anakKe = count(Sapi::where('eartag_induk', $eartagBuilder['induk'])->get()) + 1;
        // return $anakKe;

        $eartag = 'MBC-'.$eartagBuilder['generasi'].'.'.$anakKe.'-'.$eartagBuilder['induk'].'-'.$eartagBuilder['unik'];

        // return $eartag;

        $data = [
            'nama_sapi' => $request->nama_sapi,
            'tanggal_lahir' => now()->format('Y/m/d'),
            'kelamin' => $request->kelamin,
            'kondisi_lahir' => $request->kondisi_lahir,
            'anak_ke' => $anakKe,
            'eartag' => $eartag,
            'eartag_induk' => $eartagBuilder['induk'],
            'jenis_sapi_id' => $request->jenis_sapi_id,
            'status_sapi_id' => $request->status_sapi_id,
            'foto_depan' => $this->handleImageIntervention($request->foto_depan),
            'foto_samping' => $this->handleImageIntervention($request->foto_samping),
            'foto_peternak' => $this->handleImageIntervention($request->foto_peternak),
            'foto_rumah' => $this->handleImageIntervention($request->foto_rumah),
            'peternak_id' => $request->peternak_id,
        ];

        
        $sapi = new Sapi();
        $sapi->fill($data);
        $save = $sapi->save();

        
        $peternak = Peternak::find($request->peternak_id);
       
        PeternakSapi::create([
            'date' => now()->format('Y/m/d'),
            'sapi_id' => $sapi->id,
            'peternak_id' => $request->peternak_id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id
        ]);

        $this->generate($sapi);

        //performa

        $image = $request->image;

        if (!empty($image)) {
            // $image->store('public/produk_photo');
            $imageName = $this->handleImageIntervention($request->image);
        }

        $dataPerforma = [
            'tanggal_performa' => now()->format('Y/m/d'),
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'panjang_badan' => $request->panjang_badan,
            'lingkar_dada' => $request->lingkar_dada,
            'bsc' => $request->bsc,
            'sapi_id' => $sapi->id,
            'peternak_id' => $request->peternak_id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id,
            'foto' => $imageName
        ];

        
            $upah = Upah::find(2);
                    Laporan::create([
                        'sapi_id' => $sapi->id,
                        'peternak_id' => $request->peternak_id,
                        'pendamping_id' => $peternak->pendamping_id,
                        'tsr_id' => $peternak->pendamping->tsr_id,
                        'tanggal' => now()->format('Y/m/d'), 
                        'perlakuan' => $upah->detail,
                        'upah' => $upah->price,
                        ]);
        
        $save = Performa::create($dataPerforma);

            $token = $sapi->peternak->pendamping->user->remember_token;
            // dd($token);
            // echo($token.'<br/>');
            $pesan = 'Terima Kasih, Telah melakukan Recording ke Sapi '.$sapi->eartag;

            Constcoba::sendFCM($token, 'MBC', $pesan, "0");

        if ($save) {
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

    
    public function generate($sapi)
    {
        date_default_timezone_set("Asia/Makassar");

        $vitamin 		= Constcoba::nilai_vitamin;
        $anti_biotik 	= Constcoba::nilai_anti_biotik;
        $obat_cacing 	= Constcoba::nilai_obat_cacing;
        $recording 		= Constcoba::nilai_recording;
        $birahi 		= Constcoba::nilai_birahi;
        $panen 		= Constcoba::nilai_panen;
        
        $this->notif($sapi->tanggal_lahir, $vitamin, Constcoba::VITAMIN, "4", $sapi);
        // $this->notif($sapi->tanggal_lahir, $anti_biotik, Constcoba::BIOTIK, 'Pendamping', $sapi);
        // $this->notif($sapi->tanggal_lahir, $obat_cacing, Constcoba::CACING, 'Pendamping', $sapi);
        $this->notif($sapi->tanggal_lahir, $recording, Constcoba::RECORDING, "2", $sapi);
        $this->notif($sapi->tanggal_lahir, $birahi, Constcoba::BIRAHI, "0", $sapi);
        $this->notif($sapi->tanggal_lahir, $panen, Constcoba::PANEN, "5", $sapi);

        sort($this->notif);
        // dd($this->notif);
    }

    function notif($tgl, $array, $teks, $role, $sapi){
	    $s=0;//selisih
        for ($i=0; $i < count($array); $i++) {
            $s = ($i>0) ? ($array[$i]-$array[$i-1])*30 : $array[$i]*30 ;
            $tgl.=' + '.$s.' days';
            array_push($this->notif,array(date('Y-m-d', strtotime($tgl)),$teks,$role, $sapi));
            Notifikasi::create([
                'sapi_id' => $sapi->id,
                'tanggal' => date('Y-m-d', strtotime($tgl)),
                'pesan' => $teks,
                'role' => $role
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    public function master()
    {
        return 'hahahha';
    }
}
