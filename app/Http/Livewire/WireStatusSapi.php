<?php

namespace App\Http\Livewire;

use App\Models\Sapi;
use App\Models\StatusSapi;
use Livewire\Component;

class WireStatusSapi extends Component
{
    public $sapi_id, $status, $ket_status, $selectedItemId, $searchTerm, $sapiId;

    protected $rules = [
        'sapi_id' => 'required',
        'status' => 'required',
        'ket_status' => 'required',
    ];
    protected $messages = [
        'email.required' => 'this field is required.',
        'name.required' => 'this field is required.',  
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function resultData()
    {
        return StatusSapi::with('sapi')->orderBy('sapi_id')
         ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('status','like','%'.$this->searchTerm.'%');
                $query->orWhere('ket_status','like','%'.$this->searchTerm.'%');  
            }

            if($this->sapiId != null){
                $query->Where('sapi_id','like','%'.$this->sapiId.'%');
            }
        })
        ->get();
    }
    public function render()
    {
        return view('livewire.wire-status-sapi',[
            'statussapis' => $this->resultData(),
            'sapis' => Sapi::orderBy('nama_sapi')->get()
        ]);
    }

    public function selectedItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit()
    {
        $data = StatusSapi::find($this->selectedItemId);
        $this->sapi_id = $data->sapi_id;
        $this->status = $data->status;
        $this->ket_status = $data->ket_status;
        
    }

     public function save()
    {

        $data = $this->validate();
        $save = $this->selectedItemId ?   StatusSapi::find($this->selectedItemId)->update($data) : StatusSapi::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");
        $this->cleanVars(); 
         
    }
    public function delete()
    {
        $delete = StatusSapi::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }

    public function cleanVars()
    {
        
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->status = null;
        $this->ket_status = null;

        
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
