<?php

namespace App\Http\Livewire\Performa;

use App\Models\Laporan;
use App\Models\Pendamping;
use App\Models\Performa;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Upah;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;


class WireFormPerformaAdd extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $selectedItemId, $tinggi_badan, $berat_badan = 0, $panjang_badan, $lingkar_dada, $bsc, $sapi_id;
    public $date, $foto;
    public $query, $search_results, $how_many, $sapiEartag = '';

    protected $rules = [
        'tinggi_badan' => 'required',
        'berat_badan' => 'nullable',
        'panjang_badan' => 'required',
        'lingkar_dada' => 'required',
        'bsc' => 'required',
        'sapi_id' => 'required',
    ];

    protected $messages = [
        'tanggal_performa.required' => 'this field is required.',
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
        return view('livewire.performa.wire-form-performa-add',[
            'sapis' => $this->resultData(),
            'pendampings' => Pendamping::orderBy('id','ASC')->get(),
            'tsrs' => Tsr::orderBy('id','ASC')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get()
        ]);
    }

    public function save()
    {
        // dd($this->foto);
        date_default_timezone_set("Asia/Makassar");

        $validateData = [];
        $validateData = array_merge($validateData,[
            'tinggi_badan' => 'required',
            'berat_badan' => 'nullable|integer',
            'panjang_badan' => 'required',
            'lingkar_dada' => 'required',
            'bsc' => 'required',
            'sapi_id' => 'required',
        ]);

        if (!$this->selectedItemId) {
            $validateData = array_merge($validateData,[
                'foto' => 'required|image|max:1024',
            ]);
        }

        $data = $this->validate($validateData);

        $data['tanggal_performa'] = $this->date;

        $sapi = Sapi::find($this->sapi_id);
        $peternak = Peternak::find($sapi->peternak_id);

        $res_foto = $this->foto;
        if (!empty($res_foto)){
            $data['foto'] = $this->handleImageIntervention($res_foto);
        }

        $data['peternak_id'] = $peternak->id;
        $data['pendamping_id'] = $peternak->pendamping_id;
        $data['tsr_id'] = $peternak->pendamping->tsr_id;

        if ($this->berat_badan == "" || $this->berat_badan == null) {
            $data['berat_badan'] = 0;
        }
        
        $save = $this->selectedItemId ? Performa::find($this->selectedItemId)->update($data) : Performa::create($data);
        
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        if (!$this->selectedItemId) {
            $upah = Upah::find(2);
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
    }
    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $data = Performa::find($modelId);
        $this->tinggi_badan = $data->tinggi_badan;
        $this->berat_badan = $data->berat_badan;
        $this->panjang_badan = $data->panjang_badan;
        $this->lingkar_dada = $data->lingkar_dada;
        $this->bsc = $data->bsc;
        $this->sapi_id = $data->sapi_id;

        $sapi = Sapi::find($this->sapi_id);
        $this->sapiEartag = 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag;
       

     }

    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->tinggi_badan = null;
        $this->berat_badan = null;
        $this->panjang_badan = null;
        $this->lingkar_dada = null;
        $this->bsc = null;
        $this->sapi_id = null;
        $this->sapiEartag = null;
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
