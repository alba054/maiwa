<?php

namespace App\Http\Livewire;

use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Ternak;
use Livewire\Component;

class Wireternak extends Component
{
    public $selectedItemId, $tgl_mulai, $peternak_id, $sapi_id;

     protected $rules = [
        'tgl_mulai' => 'required',
        'peternak_id' => 'required',
        'sapi_id' => 'required',
    ];
    protected $messages = [
        'tgl_mulai.required' => 'this field is required.',
        'peternak_id.required' => 'this field is required.',  
        'sapi_id.required' => 'this field is required.',  
    ];

    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'refreshParent'=>'$refresh',
    ];
    public function render()
    {
        return view('livewire.wireternak',[
            'ternaks' => Ternak::with(['peternak','sapi'])->orderBy('peternak_id','ASC')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get(),
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get()
        ]);
    }

    public function selectedItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit()
    {
        $data = Ternak::find($this->selectedItemId);
        $this->peternak_id = $data->peternak_id;
        $this->sapi_id = $data->sapi_id;
        
    }

    public function save()
    {

        $this->selectedItemId ?   $this->update() : $this->store();    
         
    }
    public function store()
    {
        $data = $this->validate();
        $save = Ternak::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();   
        
    }
    public function update()
    {
         $validateData = [];
        
        $validateData = array_merge($validateData,[
            'peternak_id' => 'required',
            'sapi_id' => 'required',
        ]);

        $data = $this->validate($validateData);

        if($this->tgl_mulai){
            $data['tgl_mulai'] = $this->tgl_mulai;
        }

        $save = Ternak::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();   
    }

    public function delete()
    {
        $delete = Ternak::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }
    public function cleanVars()
    {
        $this->dispatchBrowserEvent('cleanTgl');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->tgl_mulai = null;
        $this->peternak_id = null;
        $this->sapi_id = null;

        
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
