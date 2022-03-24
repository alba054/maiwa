<?php

namespace App\Http\Livewire\Mati;

use App\Helper\Constcoba;
use App\Models\Notifikasi;
use App\Models\Panen;
use App\Models\Peternak;
use App\Models\Sapi;
use Intervention\Image\ImageManager;
use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Collection;



class WireMonMatiAdd extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $foto, $date, $selectedItemId, $sapi_id, $keterangan;

    public $query;
    public $search_results;
    public $how_many;
    public $sapiEartag = '';

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];

    public function updatedQuery() {
        // dd($this->dataSapi());
        $this->search_results = $this->dataSapi()
            ->take($this->how_many);
    }

    public function loadMore() {
        $this->how_many += 5;
        $this->updatedQuery();
    }

    public function resetQuery() {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();
    }
    public function selectSapi($sapiId) {
        $sapi = Sapi::find($sapiId);
        $this->sapi_id = $sapi->id;
        $this->sapiEartag = 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag;
        // dd($sapiId);
        
    }
    public function dataSapi()
    {
       
        $sapi =  Sapi::orderBy('generasi')
        // ->where('kondisi_lahir' ,'!=', 'Mati')
        ->where('eartag', 'like', '%' . $this->query . '%')
        ->orWhere('generasi', 'like', '%' . $this->query . '%')
        ->orWhere('nama_sapi', 'like', '%' . $this->query . '%')
        ->get();

        // dd(count($sapi));

        $data = Collection::empty();
        foreach ($sapi as $key => $value) {
            if ($value->kondisi_lahir != 'Mati') {
                if ($value->panens->last() != null) {
                    if ($value->panens->last()->role != 1) {
                        $data->push($value);  
                    }
                }else {
                    $data->push($value);  
                }
            }
            
            
        }

        return $data;
    }

    public function resultData()
    {
       
        $sapi =  Sapi::orderBy('generasi')
        ->where('kondisi_lahir' ,'!=', 'Mati')
        ->get();

        $data = [];
        foreach ($sapi as $key => $value) {
            if ($value->panens->last() != null) {
                if ($value->panens->last()->role != 1) {
                    array_push($data, $value);   
                }
            }else {
                array_push($data, $value);
                
            }
            
        }

        return $data;
    }

    public function render()
    {
        return view('livewire.mati.wire-mon-mati-add',[
            'sapis' => $this->resultData(),
            'keterangans' => Constcoba::getStatus()->where('status','Mati'),

        ]);
    }
    public function save()
    {
        date_default_timezone_set("Asia/Makassar");

        $validateData = [];
        $validateData = array_merge($validateData,[
            'sapi_id' => 'required',
            'keterangan' => 'required',
        ]);

        if (!$this->selectedItemId) {
            $validateData = array_merge($validateData,[
                'foto' => 'required|image|max:1024',
            ]);
        }

        $data = $this->validate($validateData);

        $data['tanggal'] = now()->format('Y/m/d');
        $data['status'] = 'Mati';

        $res_foto = $this->foto;
        if (!empty($res_foto)){
            $data['foto'] = $this->handleImageIntervention($res_foto);
        }
    

        $sapi = Sapi::find($this->sapi_id);
        $peternak = Peternak::find($sapi->peternak_id);

            $data['peternak_id'] = $peternak->id;
            $data['pendamping_id'] = $peternak->pendamping_id;
            $data['tsr_id'] = $peternak->pendamping->tsr_id;
            
            $data['role'] = 1;

            $deleteNotif = Notifikasi::where('sapi_id',$this->sapi_id)
            ->where('status', 'no')
            ->delete();
            
            $save = $this->selectedItemId ? Panen::find($this->selectedItemId)->update($data) : Panen::create($data);
            $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

    
            
            $this->emit('refreshParent');
            $this->dispatchBrowserEvent('closeModalAdd');
            $this->cleanVars();  

        
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
    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $data = Panen::find($modelId);
        $this->sapi_id = $data->sapi_id;
        $this->keterangan = $data->keterangan;

        $sapi = Sapi::find($this->sapi_id);
        $this->sapiEartag = 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag;
       
     }

    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->foto = null;
        $this->keterangan = null;
        $this->sapiEartag = null;
    }
   
   public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->resetValidation();
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
    public function isError($msg)
    {
        $this->alert('error', $msg, [
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
