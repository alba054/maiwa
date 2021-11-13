<?php

namespace App\Http\Livewire;

use App\Models\Kabupaten;
use Livewire\Component;
use Livewire\WithPagination;

class Wirekabupaten extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectedItemId, $name, $searchTerm;
    protected $rules = [
        'name' => 'required|string|max:255',
    ];
    protected $messages = [
        'name.required' => 'Nama Kabupaten diisi dlu bre.',
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function render()
    {
        return view('livewire.wirekabupaten',[
            'datas' => $this->resultData()
        ]);
    }

    public function resultData()
    {
        return Kabupaten::orderBy('name', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('name','like','%'.$this->searchTerm.'%');
            }
        })
        ->paginate(10);


    }
    public function selectedItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit()
    {
        $data = Kabupaten::find($this->selectedItemId);
        $this->name = $data->name;
    }
    
    public function save()
    {
        $data = $this->validate();
        $save = $this->selectedItemId ? Kabupaten::find($this->selectedItemId)->update($data)  : Kabupaten::create($data);  
        
        $save ? $this->isSuccess("Success") : $this->isError("Failed");

        $this->cleanVars();
    }
    
    public function delete()
    {
        $kabupaten = Kabupaten::find($this->selectedItemId);
        $kabupaten->kecamatans()->delete();
        $delete = $kabupaten->delete();

        // $delete = Kabupaten::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->name = null;
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
