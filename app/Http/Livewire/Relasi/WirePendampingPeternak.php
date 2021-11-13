<?php

namespace App\Http\Livewire\Relasi;

use App\Models\Pendamping;
use App\Models\PendampingPeternak;
use App\Models\Peternak;
use App\Models\Tsr;
use App\Models\TsrPendamping;
use Livewire\Component;
use Livewire\WithPagination;

class WirePendampingPeternak extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $peternak_id, $pendamping_id, $date, $selectedItemId, $searchTerm, $tsrId, $pendampingId, $peternakId;

    protected $rules = [
        'peternak_id' => 'required',
        'pendamping_id' => 'required',
    ];
    protected $messages = [
        'peternak_id.required' => 'this field is required.',
        'pendamping_id.required' => 'this field is required.', 
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function resultData()
    {
        return  PendampingPeternak::latest()
        ->where(function ($query){
            if($this->tsrId != null){
                $query->Where('tsr_id','like','%'.$this->tsrId.'%');
            }
            if($this->pendampingId != null){
                $query->Where('pendamping_id','like','%'.$this->pendampingId.'%');
            }
            if($this->peternakId != null){
                $query->Where('peternak_id','like','%'.$this->peternakId.'%');
            }
        })
        ->paginate();
        
    }
    public function render()
    {
        return view('livewire.relasi.wire-pendamping-peternak',[
            'datas' => $this->resultData(),
            'pendampings' => Pendamping::orderBy('user_id')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak')->get(),
            'tsrpendamping' => TsrPendamping::orderBy('id','DESC')->get(),
            'tsrs' => Tsr::orderBy('user_id')->get(),

        ]);
    }

    public function submit()
    {
        date_default_timezone_set("Asia/Makassar");

        $data = $this->validate();

        $tsr_id = TsrPendamping::orderBy('id','DESC')->where('pendamping_id', $this->pendamping_id)->first()->tsr_id;
        $data['date'] = now()->format('Y-m-d');
        $data['tsr_id'] = $tsr_id;
        $save = $this->selectedItemId ?   PendampingPeternak::find($this->selectedItemId)->update($data) : PendampingPeternak::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");
        $this->cleanVars();  

    }

    public function selectedItem($itemId, $action){

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit(){
        $data = PendampingPeternak::find($this->selectedItemId);
        $this->peternak_id = $data->peternak_id;
        $this->pendamping_id = $data->pendamping_id;
    }
    public function delete(){
        $delete = PendampingPeternak::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }

    public function cleanVars(){
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->peternak_id = null;
        $this->pendamping_id = null;
        $this->date = null;
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
