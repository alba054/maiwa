<?php

namespace App\Http\Livewire;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelompok;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Wirepeternak extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $selectedItemId, $searchTerm, $pendampingId, $tsrId, $desaId, $kecamatanId, $kabupatenId;

    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'refreshParent'=>'$refresh',
        'formFilter'
    ];
    public function resultData()
    {
        $tsrId = $this->tsrId;
        $kecamatanId = $this->kecamatanId;
        $kabupatenId = $this->kabupatenId;

        return Peternak::with('pendamping')
        ->orderBy('nama_peternak','ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('nama_peternak','like','%'.$this->searchTerm.'%');
                $query->orWhere('tgl_lahir','like','%'.$this->searchTerm.'%');
                $query->orWhere('no_hp','like','%'.$this->searchTerm.'%');
            } 
            
            if($this->pendampingId != null){
                $query->Where('pendamping_id','like','%'.$this->pendampingId.'%');
            }
            if($this->desaId != null){
                $query->Where('desa_id','like','%'.$this->desaId.'%');
            }
        })
        ->whereHas('pendamping', function($q) use($tsrId) {
            
            if($tsrId != null){
                $q->where('tsr_id', $tsrId);
            }
            
        })
        ->whereHas('desa', function($q) use($kecamatanId) {
            
            if($kecamatanId != null){
                $q->where('kecamatan_id', $kecamatanId);
            }
            

            
        })
        ->whereHas('desa.kecamatan', function($q) use($kabupatenId) {
            
            
            if($kabupatenId != null){
                $q->where('kabupaten_id', $kabupatenId);
            }

            
        })
        ->paginate(10);
    }
    public function render()
    {
        
        return view('livewire.wirepeternak',[
            'peternaks' => $this->resultData(),
            'pendampings' => Pendamping::latest()->get(),
        ]);
    }

     public function create()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModal');
    }
    public function openSearchModal()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModalSearch');
    }

    public function formFilter($data)
    {
        // dd($data['startDate']);

        $this->pendampingId = $data['pendampingId'];
        $this->tsrId = $data['tsrId'];
        $this->desaId = $data['desaId'];
        $this->kecamatanId = $data['kecamatanId'];
        $this->kabupatenId = $data['kabupatenId'];


    }

    public function selectemItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;

        if($action == 'delete'){
            $this->triggerConfirm();
        }else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModal');
        }
        
    }
   
    public function delete()
    {
        
        $delete = Peternak::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        
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
