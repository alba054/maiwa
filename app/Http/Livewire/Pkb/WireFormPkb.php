<?php

namespace App\Http\Livewire\Pkb;

use App\Models\Hasil;
use App\Models\Laporan;
use App\Models\Metode;
use App\Models\PeriksaKebuntingan;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Upah;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class WireFormPkb extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $foto, $selectedItemId, $metode_id, $hasil_id, $sapi_id, $waktu_pk, $status;
    protected $rules = [
        'metode_id' => 'required',
        'hasil_id' => 'required',
        'sapi_id' => 'required',
        'foto' => 'required',
        'status' => 'required',

    ];
    protected $messages = [
        
        'metode_id.required' => 'this field is required.',  
        'hasil_id.required' => 'this field is required.',  
        'sapi_id.required' => 'this field is required.',  
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];

    public function render()
    {
        return view('livewire.pkb.wire-form-pkb',[
            'metodes' => Metode::orderBy('metode','ASC')->get(),
            'hasils' => Hasil::orderBy('hasil','ASC')->get(),
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get(),
            
        ]);
    }

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');
        $this->waktu_pk = $today;
    }

    public function save(){
        // dd($this->status);
        $this->selectedItemId ?   $this->update() : $this->store();    
    }

    public function store()
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');

        $data = $this->validate();
        $data['waktu_pk'] = $today;

        $user = PeternakSapi::orderBy('id','DESC')->where('sapi_id', $this->sapi_id)->first();
        if ($user) {
            $res_foto = $this->foto;
            if (!empty($res_foto)){
                $data['foto'] = $this->handleImageIntervention($res_foto);
            }
    
            $data['peternak_id'] = $user->peternak_id;
            $data['pendamping_id'] = $user->pendamping_id;
            $data['tsr_id'] = $user->tsr_id;
    
            // dd($data);
            $save = $this->selectedItemId ? PeriksaKebuntingan::find($this->selectedItemId)->update($data) : PeriksaKebuntingan::create($data);
            $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");
    
            $upah = Upah::find(1);
            Laporan::create([
               'sapi_id' => $this->sapi_id,
               'peternak_id' => $data['peternak_id'], 
               'pendamping_id' => $data['pendamping_id'], 
               'tsr_id' => $data['tsr_id'], 
               'tanggal' => $today, 
               'perlakuan' => $upah->detail,
               'upah' => $upah->price,
            ]);
            
            $this->emit('refreshParent');
            $this->dispatchBrowserEvent('closeModalAdd');
            $this->cleanVars();  

        } else {
            $this->isError("Belum ada relasi sapi");
        }
        
        
        
    }
    public function update()
    {
         $validateData = [];
        
        $validateData = array_merge($validateData,[
            'metode_id' => 'required',
            'hasil_id' => 'required',
            'sapi_id' => 'required',
            'status' => 'required',
        ]);

        $data = $this->validate($validateData);

        $save = PeriksaKebuntingan::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();   
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalAdd');
    }

    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $data = PeriksaKebuntingan::find($modelId);
       $this->metode_id = $data->metode_id;
       $this->hasil_id = $data->hasil_id;
       $this->sapi_id = $data->sapi_id;
       $this->waktu_pk = $data->waktu_pk;
       $this->status = $data->status;

     }

    public function cleanVars()
    {
       $this->selectedItemId = null;
       $this->foto = null;
       $this->metode_id = null;
       $this->hasil_id = null;
       $this->sapi_id = null;
       $this->waktu_pk = null;
       $this->status = null;
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
        $data['foto'] = $imageName;

        $manager = new ImageManager();
        $image = $manager->make('storage/photos/'.$imageName)->resize(500,300);
        $image->save('storage/photos_thumb/'.$imageName);

        return $imageName;
    }

    public function triggerConfirm()
    {
        $this->confirm('yakin akan menghapus data ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' =>  true, 
            'onConfirmed' => 'delete',
            'onCancelled' => 'cancelled'
        ]);
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
    public function confirmed()
    {
        // Example code inside confirmed callback
    
        $this->alert('success', 'Hello World!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  '', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  true, 
            'showConfirmButton' =>  true, 
      ]);
    }
    
    public function cancelled()
    {
        // Example code inside cancelled callback
    
        $this->alert('info', 'Understood');
    }

}
