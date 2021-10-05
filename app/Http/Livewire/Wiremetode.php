<?php

namespace App\Http\Livewire;

use App\Models\Metode;
use Livewire\Component;

class Wiremetode extends Component
{
    public $selectedItemId, $metode, $searchTerm;
    protected $rules = [
        'metode' => 'required|string|max:255',
    ];
    protected $messages = [
        'metode.required' => 'Nama Metode diisi dlu bre.',
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];
    public function render()
    {
        return view('livewire.wiremetode',[
            'datas' => $this->resultData()
        ]);
    }
    public function resultData()
    {
        return Metode::orderBy('metode', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('metode','like','%'.$this->searchTerm.'%');
            }
        })
        ->get();


    }
    public function selectedItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit()
    {
        $data = Metode::find($this->selectedItemId);
        $this->metode = $data->metode;
    }
    
    public function save()
    {
        $data = $this->validate();
        $this->selectedItemId ? $this->update($data)  : $this->store($data);       
    }
    public function store($data)
    {
    
        $save = Metode::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();

    }
    public function update($data)
    {
        
        
        $save = Metode::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil diUbah") : $this->isError("Data Gagal diUbah");

        $this->cleanVars();

    }
    public function delete()
    {
        
        $delete = Metode::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->metode = null;
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
