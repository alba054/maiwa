<?php

namespace App\Http\Livewire;

use App\Models\Perlakuan;
use App\Models\Sapi;
use App\Models\User;
use Livewire\Component;

class WireMonPerlakuan extends Component
{
    public $selectedItemId;
    public $startDate, $endDate, $sapiId, $userId;


    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'refreshParent'=>'$refresh',
    ];

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        $this->startDate = now()->subDays(30)->format('Y/m/d');
        $this->endDate = now()->format('Y/m/d');

    }
    public function resultData()
    {
        // dd("start ".$this->startDate.", end ".$this->endDate);

        $haha = $this->userId;
        return Perlakuan::with('sapi')
        ->where(function ($query){
            // if($this->searchTerm != ""){
            //     $query->where('metode','like','%'.$this->searchTerm.'%');
            //     $query->orWhere('hasil','like','%'.$this->searchTerm.'%');
                
            // }
            if($this->sapiId != null){
                $query->Where('sapi_id','like','%'.$this->sapiId.'%');
            }
            // if($this->statusId != null){
            //     $query->Where('status','like','%'.$this->statusId.'%');
            // }
            
        })
        ->whereHas('sapi.peternak', function($q) use($haha) {
            if($haha != null){
                $q->where('user_id', $haha);
            }
        })
        ->WhereBetween('tgl_perlakuan',[$this->startDate, $this->endDate])
        ->get();
    }
    public function render()
    {
        return view('livewire.wire-mon-perlakuan',[
            'perlakuans' => $this->resultData(),
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get(),
            'users' => User::where('hak_akses',2)->get()
        ]);
    }

    public function create()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModal');
    }

    public function selectedItem($itemId, $action)
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
        
        $delete = Perlakuan::destroy($this->selectedItemId);
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
