<?php

namespace App\Http\Livewire;

use App\Models\Vaksin;
use Livewire\Component;

class Wirevaksin extends Component
{
    public $selectedItemId, $name, $detail, $searchTerm;
    protected $rules = [
        'name' => 'required|string|max:255',
        'detail' => 'required|string|max:255',
    ];
    protected $messages = [
        'name.required' => 'Nama Vaksin diisi dlu bre.',
        'detail.required' => 'Keterangan diisi dlu bre.',
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];
    public function render()
    {
        return view('livewire.wirevaksin',[
            'datas' => $this->resultData()
        ]);
    }
    public function resultData()
    {
        return Vaksin::orderBy('name', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('name','like','%'.$this->searchTerm.'%');
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
        $data = Vaksin::find($this->selectedItemId);
        $this->name = $data->name;
        $this->detail = $data->detail;
    }
    
    public function save()
    {
        $data = $this->validate();
        $this->selectedItemId ? $this->update($data)  : $this->store($data);       
    }
    public function store($data)
    {
    
        $save = Vaksin::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();

    }
    public function update($data)
    {
        
        
        $save = Vaksin::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil diUbah") : $this->isError("Data Gagal diUbah");

        $this->cleanVars();

    }
    public function delete()
    {
        
        $delete = Vaksin::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->name = null;
        $this->detail = null;
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
