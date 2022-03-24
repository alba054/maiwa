<?php

namespace App\Http\Livewire\Panen;


use App\Helper\Constcoba;
use App\Models\Laporan;
use App\Models\Panen;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Upah;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;


class WireMonPanenAdd extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $foto, $date, $selectedItemId, $status, $keterangan, $sapi_id;
    public $tanggal_lahir;
    public $query, $search_results, $how_many, $sapiEartag = '';


    protected $rules = [
        'status' => 'required',
        'sapi_id' => 'required',
    ];
    protected $messages = [
        'status.required' => 'this field is required.',
        'sapi_id.required' => 'this field is required.',
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];
    public function mount()
    {
        // dd(Constcoba::getStatus()->where('status','Jual'));
    }
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
        ->where('kondisi_lahir' ,'!=', 'Mati')
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
       if ($this->sapi_id) {
           $this->tanggal_lahir = Sapi::find($this->sapi_id)->tanggal_lahir;
       }else {
        $this->tanggal_lahir = null;
           
       }
        return view('livewire.panen.wire-mon-panen-add',[
            'sapis' => $this->resultData(),
            'keterangans' => Constcoba::getStatus()->where('status','Jual'),
        ]);
    }

    public function save()
    {
        date_default_timezone_set("Asia/Makassar");

        $validateData = [];
        $validateData = array_merge($validateData,[
            'status' => 'required',
            'sapi_id' => 'required',
        ]);

        if (!$this->selectedItemId) {
            $validateData = array_merge($validateData,[
                'foto' => 'required|image|max:1024',
            ]);
        }

        $data = $this->validate($validateData);

        $data['tanggal'] = now()->format('Y/m/d');

        

        $res_foto = $this->foto;
            if (!empty($res_foto)){
                $data['foto'] = $this->handleImageIntervention($res_foto);
            }

        if (!$this->selectedItemId) {
            $count = Panen::where(['role'=> 0, 'sapi_id' => $this->sapi_id])->get();
            $data['keterangan'] = 'Panen '.count($count) + 1;
        }
    

        $sapi = Sapi::find($this->sapi_id);
        $peternak = Peternak::find($sapi->peternak_id);

            $data['peternak_id'] = $peternak->id;
            $data['pendamping_id'] = $peternak->pendamping_id;
            $data['tsr_id'] = $peternak->pendamping->tsr_id;

            $save = $this->selectedItemId ? Panen::find($this->selectedItemId)->update($data) : Panen::create($data);
            
            $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");
    
            if (!$this->selectedItemId) {
                $upah = Upah::find(5);
                    Laporan::create([
                        'sapi_id' => $this->sapi_id,
                        'peternak_id' => $data['peternak_id'], 
                        'pendamping_id' => $data['pendamping_id'], 
                        'tsr_id' => $data['tsr_id'], 
                        'tanggal' => now()->format('Y/m/d'), 
                        'perlakuan' => $upah->detail,
                        'upah' => $upah->price,
                        ]);
            }

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
        $this->status = $data->status;
        $this->keterangan = $data->keterangan;

        $sapi = Sapi::find($this->sapi_id);
        $this->sapiEartag = 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag;
       

     }

    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->keterangan = null;
        $this->status = null;
        $this->foto = null;
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
