<?php

namespace App\Http\Livewire;
use App\Models\JenisSapi;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class WireJenisSapi extends Component
{
    use LivewireAlert;

    public $selectedItemId, $jenis, $ket_jenis, $searchTerm;
    protected $rules = [
        'jenis' => 'required|string|max:255',
        'ket_jenis' => 'required|max:255',
    ];
    protected $messages = [
        'jenis.required' => 'this field is required.',
        'ket_jenis.required' => 'this field is required.',  
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function resultData()
    {
        return JenisSapi::orderBy('jenis', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('jenis','like','%'.$this->searchTerm.'%');
                $query->orWhere('ket_jenis','like','%'.$this->searchTerm.'%');
                
            }
        })
        ->get();


    }
    public function render()
    {
        return view('livewire.wire-jenis-sapi',[
            'datas' => $this->resultData()
        ]);
    }

    public function selectemItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit()
    {
        $data = JenisSapi::find($this->selectedItemId);
        $this->jenis = $data->jenis;
        $this->ket_jenis = $data->ket_jenis;
    }
    
    public function save()
    {
        $data = $this->validate();

        $this->selectedItemId ? $this->update($data)  : $this->store($data);       
    }
    public function store($data)
    {
    
        $save = JenisSapi::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();

    }
    public function update($data)
    {
        
        
        $save = JenisSapi::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil diUbah") : $this->isError("Data Gagal diUbah");

        $this->cleanVars();

    }
    public function delete()
    {
        
        $delete = JenisSapi::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->jenis = null;
        $this->ket_jenis = null;
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
