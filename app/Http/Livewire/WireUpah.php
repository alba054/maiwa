<?php

namespace App\Http\Livewire;

use App\Models\Upah;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class WireUpah extends Component
{
    use LivewireAlert;

    public $selectedItemId, $status, $detail, $price, $searchTerm;
    protected $rules = [
        'status' => 'required',
        'price' => 'required',
        'detail' => 'required|string|max:255',
    ];
    protected $messages = [
        'detail.required' => 'This field is required.',
        'status.required' => 'This field is required.',
        'price.required' => 'This field is required.',
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];
    public function render()
    {
        return view('livewire.wire-upah',[
            'datas' => $this->resultData()
        ]);
    }
    public function resultData()
    {
        return Upah::orderBy('status', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('detail','like','%'.$this->searchTerm.'%');
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
        $data = Upah::find($this->selectedItemId);
        $this->status = $data->status;
        $this->detail = $data->detail;
        $this->price = $data->price;
    }
    
    public function submit()
    {
        $data = $this->validate();
        $save = $this->selectedItemId ? Upah::find($this->selectedItemId)->update($data)  : Upah::create($data);       
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();
    }
    
    public function delete()
    {
        
        $delete = Upah::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->status = null;
        $this->detail = null;
        $this->price = null;
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
