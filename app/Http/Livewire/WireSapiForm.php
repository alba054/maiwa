<?php

namespace App\Http\Livewire;

use App\Models\JenisSapi;
use App\Models\Peternak;
use App\Models\Sapi;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class WireSapiForm extends Component
{
    use WithFileUploads;
    public $selectedItemId, $jenis_sapi_id, $peternak_id, $ertag_induk, $nama_sapi,  $tanggal_lahir, $kelamin, $kondisi_lahir, $anak_ke, $ertag, $foto_depan, $foto_belakang, $foto_kiri, $foto_kanan;

    protected $rules = [
        'jenis_sapi_id' => 'required',
        'peternak_id' => 'required',
        'ertag_induk' => 'required',
        'nama_sapi' => 'required',
        'tanggal_lahir' => 'required',
        'kelamin' => 'required',
        'kondisi_lahir' => 'required',
        'anak_ke' => 'required',
        'ertag' => 'required',
        'foto_depan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'foto_belakang' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'foto_kiri' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        'foto_kanan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ];
    protected $messages = [
        'jenis_sapi_id.required' => 'this field is required',
        'peternak_id.required' => 'this field is required',
        'ertag_induk.required' => 'this field is required',
        'nama_sapi.required' => 'this field is required',
        'tanggal_lahir.required' => 'this field is required',
        'kelamin.required' => 'this field is required',
        'kondisi_lahir.required' => 'this field is required',
        'anak_ke.required' => 'this field is required',
        'ertag.required' => 'this field is required',
        'foto_depan.required' => 'this field is required',
        'foto_belakang.required' => 'this field is required',
        'foto_kiri.required' => 'this field is required',
        'foto_kanan.required' => 'this field is required',
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];

    public function render()
    {
        return view('livewire.wire-sapi-form',[
            'jenis_sapis' => JenisSapi::orderBy('jenis','ASC')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get()
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
            'ertag_induk' => 'required',
            'nama_sapi' => 'required',
            'kelamin' => 'required',
            'kondisi_lahir' => 'required',
            'anak_ke' => 'required',
            'ertag' => 'required',
            
        ]);
        $data = $this->validate($validateData);
        
        $res_foto_depan = $this->foto_depan;
        if (!empty($res_foto_depan)){
            $data['foto_depan'] = $this->handleImageIntervention($res_foto_depan);
        }
        $res_foto_belakang = $this->foto_belakang;
        if (!empty($res_foto_belakang)){
            $data['foto_belakang'] = $this->handleImageIntervention($res_foto_belakang);
        }

        $res_foto_kanan = $this->foto_kanan;
        if (!empty($res_foto_kanan)){
            $data['foto_kanan'] = $this->handleImageIntervention($res_foto_kanan);
        }
        $res_foto_kiri = $this->foto_kiri;
        if (!empty($res_foto_kiri)){
            $data['foto_kiri'] = $this->handleImageIntervention($res_foto_kiri);
        }

        if ($this->tanggal_lahir != null) {
            $data['tanggal_lahir'] = $this->tanggal_lahir;
        }

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
        $res_foto_belakang = $this->foto_belakang;
        if (!empty($res_foto_belakang)){
            $data['foto_belakang'] = $this->handleImageIntervention($res_foto_belakang);
        }

        $res_foto_kanan = $this->foto_kanan;
        if (!empty($res_foto_kanan)){
            $data['foto_kanan'] = $this->handleImageIntervention($res_foto_kanan);
        }
        $res_foto_kiri = $this->foto_kiri;
        if (!empty($res_foto_kiri)){
            $data['foto_kiri'] = $this->handleImageIntervention($res_foto_kiri);
        }

        $save = Sapi::create($data);
        $save ? $this->emit('isSuccess',"Berhasil") : $this->emit('isError',"Terjadi kesalahan");
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();
    }

    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $model = Sapi::find($this->selectedItemId);
        $this->jenis_sapi_id = $model->jenis_sapi_id;
        $this->peternak_id = $model->peternak_id;
        $this->ertag = $model->ertag;
        $this->ertag_induk = $model->ertag_induk;
        $this->nama_sapi = $model->nama_sapi;
        $this->kelamin = $model->kelamin;
        $this->kondisi_lahir = $model->kondisi_lahir;
        $this->anak_ke = $model->anak_ke;
     }

    public function cleanVars()
     {
        $this->jenis_sapi_id = null;
        $this->peternak_id = null;
        $this->selectedItemId = null;
        $this->jenis_sapi_id = null;
        $this->ertag = null;
        $this->ertag_induk = null;
        $this->nama_sapi = null;
        $this->kelamin = null;
        $this->kondisi_lahir = null;
        $this->anak_ke = null;
        $this->foto_depan = null;
        $this->foto_belakang = null;
        $this->foto_kanan = null;
        $this->foto_kiri = null;
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
        $data['foto_kiri'] = $imageName;

        $manager = new ImageManager();
        $image = $manager->make('storage/photos/'.$imageName)->resize(100,100);
        $image->save('storage/photos_thumb/'.$imageName);

        return $imageName;
    }
}
