<?php

namespace App\Http\Livewire;

use App\Models\JenisSapi;
use App\Models\Notifikasi;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\StatusSapi;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helper\Constcoba;
use App\Models\PeternakSapi;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class WireSapiForm extends Component
{
    protected $notif = array ();
    use WithFileUploads;
    use LivewireAlert;

    public $selectedItemId, $jenis_sapi_id, $eartag_induk, $nama_sapi,  $tanggal_lahir, $kelamin, $kondisi_lahir, $anak_ke, $eartag, $foto_depan, $foto_samping, $foto_peternak, $foto_rumah, $status_sapi_id, $peternak_id;
    public $uniqNo, $f = 1;

    protected $rules = [
        'jenis_sapi_id' => 'required',
        'status_sapi_id' => 'required',
        'peternak_id' => 'required',
        'eartag_induk' => 'required',
        'nama_sapi' => 'required',
        'tanggal_lahir' => 'required',
        'kelamin' => 'required',
        'kondisi_lahir' => 'required',
        'anak_ke' => 'required',
        'eartag' => 'required',
        'foto_depan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'foto_samping' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'foto_peternak' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'foto_rumah' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ];
    protected $messages = [
        'jenis_sapi_id.required' => 'this field is required',
        'peternak_id.required' => 'this field is required',
        'status_sapi_id.required' => 'this field is required',
        'eartag_induk.required' => 'this field is required',
        'nama_sapi.required' => 'this field is required',
        'tanggal_lahir.required' => 'this field is required',
        'kelamin.required' => 'this field is required',
        'kondisi_lahir.required' => 'this field is required',
        'anak_ke.required' => 'this field is required',
        'eartag.required' => 'this field is required',
        'foto_depan.required' => 'this field is required',
        'foto_samping.required' => 'this field is required',
        'foto_peternak.required' => 'this field is required',
        'foto_rumah.required' => 'this field is required',
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'getCreateChild',
        'forceCloseModal',
    ];

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        
       
    }
    public function render()
    {
        $sapi = Sapi::all();
        if (count($sapi) > 0) {
            
            $latestSapi = Sapi::latest()->first()->eartag;
            $eartagLastSapi = explode("-", $latestSapi);


            $this->uniqNo = $eartagLastSapi[3] +1 ;
            
            $uniq = sprintf("%'03d", $this->uniqNo);
            if (!$this->selectedItemId) {
                $this->eartag = 'MBC-F'.$this->f.'.'.$this->anak_ke.'-'.$this->eartag_induk.'-'.$uniq;
            }
        }else{
            $this->eartag = 'MBC-F0.000-000-001';
        }
        

        return view('livewire.wire-sapi-form',[
            'jenis_sapis' => JenisSapi::orderBy('jenis','ASC')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get(),
            'status_sapis' => StatusSapi::orderBy('status','ASC')->get(),
        ]);
    }

    public function save()
    {
        $this->selectedItemId ? $this->update() : $this->create(); 
    }

    public function update()
    {

        $validateData = [];
        
        $validateData = array_merge($validateData,[
            'jenis_sapi_id' => 'required',
            'peternak_id' => 'required',
            'status_sapi_id' => 'required',
            'eartag_induk' => 'required',
            'nama_sapi' => 'required',
            'kelamin' => 'required',
            'kondisi_lahir' => 'required',
            'anak_ke' => 'required',
            'eartag' => 'required',
            
        ]);
        $data = $this->validate($validateData);
        
        $res_foto_depan = $this->foto_depan;
        if (!empty($res_foto_depan)){
            $data['foto_depan'] = $this->handleImageIntervention($res_foto_depan);
        }
        $res_foto_samping = $this->foto_samping;
        if (!empty($res_foto_samping)){
            $data['foto_samping'] = $this->handleImageIntervention($res_foto_samping);
        }

        $res_foto_rumah = $this->foto_rumah;
        if (!empty($res_foto_rumah)){
            $data['foto_rumah'] = $this->handleImageIntervention($res_foto_rumah);
        }
        $res_foto_peternak = $this->foto_peternak;
        if (!empty($res_foto_peternak)){
            $data['foto_peternak'] = $this->handleImageIntervention($res_foto_peternak);
        }

        if ($this->tanggal_lahir != null) {
            $data['tanggal_lahir'] = $this->tanggal_lahir;
        }

        $peternak = Peternak::find($this->peternak_id);

        PeternakSapi::create([
            'date' => now()->format('Y/m/d'),
            'sapi_id' => $this->selectedItemId,
            'peternak_id' => $this->peternak_id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id

        ]);

        $save = Sapi::find($this->selectedItemId)->update($data);
        $save ? $this->emit('isSuccess',"Berhasil") : $this->emit('isError',"Terjadi kesalahan");

        
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();
    }
    public function create()
    {
       
        $data  =  $this->validate();

        $res_foto_depan = $this->foto_depan;
        if (!empty($res_foto_depan)){
            $data['foto_depan'] = $this->handleImageIntervention($res_foto_depan);
        }
        $res_foto_samping = $this->foto_samping;
        if (!empty($res_foto_samping)){
            $data['foto_samping'] = $this->handleImageIntervention($res_foto_samping);
        }

        $res_foto_rumah = $this->foto_rumah;
        if (!empty($res_foto_rumah)){
            $data['foto_rumah'] = $this->handleImageIntervention($res_foto_rumah);
        }
        $res_foto_peternak = $this->foto_peternak;
        if (!empty($res_foto_peternak)){
            $data['foto_peternak'] = $this->handleImageIntervention($res_foto_peternak);
        }

        $sapi = new Sapi();
        $sapi->fill($data);
        $save = $sapi->save();

        
        $peternak = Peternak::find($this->peternak_id);
       
        PeternakSapi::create([
            'date' => now()->format('Y/m/d'),
            'sapi_id' => $sapi->id,
            'peternak_id' => $this->peternak_id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id

        ]);

        $save ? $this->emit('isSuccess',"Berhasil") : $this->emit('isError',"Terjadi kesalahan");
        // dd($save);

        $this->generate($sapi);

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();
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
        $this->notif($sapi->tanggal_lahir, $panen, Constcoba::PANEN, "5", $sapi);

        if ($sapi->kelamin == "Betina") {
            $this->notif($sapi->tanggal_lahir, $birahi, Constcoba::BIRAHI, "0", $sapi);
        }

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

    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $model = Sapi::find($this->selectedItemId);
        $this->jenis_sapi_id = $model->jenis_sapi_id;
        $this->status_sapi_id = $model->status_sapi_id;
        $this->peternak_id = $model->peternak_id;
        $this->eartag = $model->eartag;
        $this->eartag_induk = $model->eartag_induk;
        $this->nama_sapi = $model->nama_sapi;
        $this->kelamin = $model->kelamin;
        $this->kondisi_lahir = $model->kondisi_lahir;
        $this->anak_ke = $model->anak_ke;
     }

     public function getCreateChild($modelId)
     {
            $model = Sapi::find($modelId)->eartag;
            $eartag = explode('-',$model);
            $this->eartag_induk = $eartag[3];

            // dd($eartag[1]);
            $subs = substr($eartag[1],1,1);
            $this->f = $subs+1;


     }

    public function cleanVars()
     {
        $this->jenis_sapi_id = null;
        $this->status_sapi_id = null;
        $this->selectedItemId = null;
        $this->jenis_sapi_id = null;
        $this->eartag = null;
        $this->eartag_induk = null;
        $this->nama_sapi = null;
        $this->kelamin = null;
        $this->kondisi_lahir = null;
        $this->anak_ke = null;
        $this->foto_depan = null;
        $this->foto_samping = null;
        $this->foto_rumah = null;
        $this->foto_peternak = null;
        $this->peternak_id = null;
     }

    
    public function forceCloseModal()
     {
         $this->cleanVars();
         $this->resetErrorBag();
         $this->resetValidation();
     }

     public function handleImageIntervention($res_foto)
    {
        $res_foto->store('public/photos');
        $imageName = $res_foto->hashName();
        $data['foto_peternak'] = $imageName;

        $manager = new ImageManager();
        $image = $manager->make('storage/photos/'.$imageName)->resize(500,300);
        $image->save('storage/photos_thumb/'.$imageName);

        return $imageName;
    }
}
