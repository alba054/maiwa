<?php

namespace App\Http\Livewire\Ib;

use App\Models\InsiminasiBuatan;
use App\Models\Laporan;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Strow;
use App\Models\Upah;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class WireFormIbAdd extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $selectedItemId, $tinggi_badan, $berat_badan, $panjang_badan, $lingkar_dada, $bsc, $sapi_id;
    public $date, $foto;
    protected $rules = [
        'dosis_ib' => 'required',
        'strow_id' => 'required',
        'sapi_id' => 'required',
    ];
    protected $messages = [
        'dosis_ib.required' => 'this field is required.',
        'strow_id.required' => 'this field is required.',
        'sapi_id.required' => 'this field is required.',
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];
    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');
        $this->date = $today;
    }
    public function render()
    {
        
        return view('livewire.ib.wire-form-ib-add',[
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get(),
            'strows' => Strow::orderBy('kode_batch','ASC')->get(),
        ]);
    }
    public function save()
    {
        date_default_timezone_set("Asia/Makassar");

        $validateData = [];
        $validateData = array_merge($validateData,[
            'dosis_ib' => 'required',
            'strow_id' => 'required',
            'sapi_id' => 'required',
        ]);

        if (!$this->selectedItemId) {
            $validateData = array_merge($validateData,[
                'foto' => 'required|image|max:1024',
            ]);
        }

        $data = $this->validate($validateData);

        $data['waktu_ib'] = $this->date;

        $user = PeternakSapi::orderBy('id','DESC')->where('sapi_id', $this->sapi_id)->first();
        if ($user) {
            $res_foto = $this->foto;
            if (!empty($res_foto)){
                $data['foto'] = $this->handleImageIntervention($res_foto);
            }
    
            $data['peternak_id'] = $user->peternak_id;
            $data['pendamping_id'] = $user->pendamping_id;
            $data['tsr_id'] = $user->tsr_id;
            
            $save = $this->selectedItemId ? InsiminasiBuatan::find($this->selectedItemId)->update($data) : InsiminasiBuatan::create($data);
            
            $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");
    
            if (!$this->selectedItemId) {
                $upah = Upah::find(3);
                    Laporan::create([
                        'sapi_id' => $this->sapi_id,
                        'peternak_id' => $data['peternak_id'], 
                        'pendamping_id' => $data['pendamping_id'], 
                        'tsr_id' => $data['tsr_id'], 
                        'tanggal' => $this->date, 
                        'perlakuan' => $upah->detail,
                        'upah' => $upah->price,
                        ]);
            }

            $this->emit('refreshParent');
            $this->dispatchBrowserEvent('closeModalAdd');
            $this->cleanVars();  

        } else {
            $this->isError("Belum ada relasi sapi");
        }
    }
    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $data = InsiminasiBuatan::find($modelId);
        $this->sapi_id = $data->sapi_id;
        $this->strow_id = $data->strow_id;
        $this->waktu_ib = $data->waktu_ib;
        $this->dosis_ib = $data->dosis_ib;

     }

    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->strow_id = null;
        $this->waktu_ib = null;
        $this->dosis_ib = null;
        $this->foto = null;
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
