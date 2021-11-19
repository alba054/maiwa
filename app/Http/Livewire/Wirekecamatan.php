<?php

namespace App\Http\Livewire;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Wirekecamatan extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    
    public $selectedItemId, $name, $searchTerm, $kabupaten_id;
    public $kabupatenId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'kabupaten_id' => 'required',
    ];
    protected $messages = [
        'name.required' => 'Nama Kecamatan diisi dlu bre.',
        'kabupaten_id.required' => 'Nama Kabupaten diisi dlu bre.',
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function render()
    {
        return view('livewire.wirekecamatan',[
            'datas' => $this->resultData(),
            'kabupatens' => Kabupaten::orderBy('name','asc')->get()
        ]);
    }

    public function resultData()
    {
        return Kecamatan::orderBy('kabupaten_id', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('name','like','%'.$this->searchTerm.'%');
            }
            if($this->kabupatenId != null){
                $query->Where('kabupaten_id','like','%'.$this->kabupatenId.'%');
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
        $data = Kecamatan::find($this->selectedItemId);
        $this->name = $data->name;
        $this->kabupaten_id = $data->kabupaten_id;
    }
    
    public function save()
    {
        $data = $this->validate();
        $save = $this->selectedItemId ? Kecamatan::find($this->selectedItemId)->update($data)  : Kecamatan::create($data);  
        
        $save ? $this->isSuccess("Success") : $this->isError("Failed");

        $this->cleanVars();
    }
    
    public function delete()
    {
        $kecamatan = Kecamatan::find($this->selectedItemId);
        $kecamatan->desas()->delete();
        $delete = $kecamatan->delete();
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->name = null;
        $this->kabupaten_id = null;
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
