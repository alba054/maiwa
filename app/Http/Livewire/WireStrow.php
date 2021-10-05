<?php

namespace App\Http\Livewire;

use App\Models\Sapi;
use App\Models\Strow;
use Livewire\Component;

class WireStrow extends Component
{
    public $sapi_id, $kode_batch, $batch, $selectedItemId, $searchTerm, $sapiId;

    protected $rules = [
        'sapi_id' => 'required',
        'kode_batch' => 'required|max:255|unique:strows',
        'batch' => 'required',
    ];
    protected $messages = [
        'sapi_id.required' => 'this field is required.',
        'kode_batch.required' => 'this field is required.',  
        'batch.required' => 'this field is required.',  
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];
    public function resultData()
    {
        return Strow::orderBy('kode_batch', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('batch','like','%'.$this->searchTerm.'%');
                $query->orWhere('kode_batch','like','%'.$this->searchTerm.'%');  
            }

            if($this->sapiId != null){
                $query->Where('sapi_id','like','%'.$this->sapiId.'%');
            }
        })
        ->get();
    }
    public function render(){
        return view('livewire.wire-strow',[
            'sapis' => Sapi::orderBy('nama_sapi')->get(),
            'strows' => $this->resultData()
        ]);
    }

    public function save(){
        $data = $this->validate();
        $save = $this->selectedItemId ?   Strow::find($this->selectedItemId)->update($data) : Strow::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");
        $this->cleanVars();     
    }

    public function selectedItem($itemId, $action){

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit(){
        $data = Strow::find($this->selectedItemId);
        $this->sapi_id = $data->sapi_id;
        $this->kode_batch = $data->kode_batch;
        $this->batch = $data->batch;
        
    }
    public function delete(){
        $delete = Strow::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }

    public function cleanVars(){
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->kode_batch = null;
        $this->batch = null;
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
