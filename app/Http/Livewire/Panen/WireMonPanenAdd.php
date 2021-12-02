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

class WireMonPanenAdd extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $foto, $date, $selectedItemId, $status, $keterangan, $sapi_id;
    public $tanggal_lahir;

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
    public function render()
    {
       if ($this->sapi_id) {
           $this->tanggal_lahir = Sapi::find($this->sapi_id)->tanggal_lahir;
       }else {
        $this->tanggal_lahir = null;
           
       }
        return view('livewire.panen.wire-mon-panen-add',[
            'sapis' => Sapi::orderBy('generasi','ASC')->get(),
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

     }

    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->keterangan = null;
        $this->status = null;
        $this->foto = null;
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
