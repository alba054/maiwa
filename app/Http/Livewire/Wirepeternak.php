<?php

namespace App\Http\Livewire;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Peternak;
use App\Models\User;
use Livewire\Component;

class Wirepeternak extends Component
{
    
    public $selectedItemId, $searchTerm, $userId;

    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'refreshParent'=>'$refresh',
    ];
    public function resultData()
    {
        return Peternak::with('user')
        ->orderBy('nama_peternak','ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('nama_peternak','like','%'.$this->searchTerm.'%');
            } 
            
            if($this->userId != null){
                $query->Where('user_id','like','%'.$this->userId.'%');
            }
        })
        ->get();
    }
    public function render()
    {
        
        return view('livewire.wirepeternak',[
            'peternaks' => $this->resultData(),
            'users' => User::where('hak_akses',2)->get()

        ]);
    }

     public function create()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModal');
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
