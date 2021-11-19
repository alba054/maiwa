<?php

namespace App\Http\Livewire;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Wiredesa extends Component
{
    use WithPagination;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $selectedItemId, $name, $searchTerm, $kecamatan_id;

    public $kecamatanId, $kabupatenId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'kecamatan_id' => 'required',
    ];
    protected $messages = [
        'name.required' => 'Nama Kecamatan diisi dlu bre.',
        'kecamatan_id.required' => 'Nama Kabupaten diisi dlu bre.',
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function render()
    {
        return view('livewire.wiredesa',[
            'datas' => $this->resultData(),
            'kecamatans' => Kecamatan::orderBy('name','asc')->get(),
            'kabupatens' => Kabupaten::orderBy('name','asc')->get(),
        ]);
    }

    public function resultData()
    {
        $kabupatenId = $this->kabupatenId;
        return Desa::orderBy('kecamatan_id', 'ASC')
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('name','like','%'.$this->searchTerm.'%');
            }
            if($this->kecamatanId != null){
                $query->Where('kecamatan_id','like','%'.$this->kecamatanId.'%');
            }
        })
        ->whereHas('kecamatan', function($q) use($kabupatenId) {
            
            if($kabupatenId != null){
                $q->where('kabupaten_id', $kabupatenId);
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
        $data = Desa::find($this->selectedItemId);
        $this->name = $data->name;
        $this->kecamatan_id = $data->kecamatan_id;
    }
    
    public function save()
    {
        $data = $this->validate();
        $save = $this->selectedItemId ? Desa::find($this->selectedItemId)->update($data)  : Desa::create($data);  
        
        $save ? $this->isSuccess("Success") : $this->isError("Failed");

        $this->cleanVars();
    }
    
    public function delete()
    {
        
        $delete = Desa::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->name = null;
        $this->kecamatan_id = null;
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
