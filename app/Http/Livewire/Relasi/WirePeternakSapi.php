<?php

namespace App\Http\Livewire\Relasi;

use App\Models\Notifikasi;
use App\Models\Pendamping;
use App\Models\PendampingPeternak;
use App\Models\Peternak;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use Livewire\Component;

class WirePeternakSapi extends Component
{
    public $peternak_id, $sapi_id, $date, $selectedItemId, $searchTerm, $pendampingId, $peternakId, $sapiId;

    protected $rules = [
        'peternak_id' => 'required',
        'sapi_id' => 'required',
    ];
    protected $messages = [
        'peternak_id.required' => 'this field is required.',
        'sapi_id.required' => 'this field is required.', 
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function resultData()
    {
        return  PeternakSapi::latest()
        ->where(function ($query){
            if($this->pendampingId != null){
                $query->Where('pendamping_id','like','%'.$this->pendampingId.'%');
            }
            if($this->peternakId != null){
                $query->Where('peternak_id','like','%'.$this->peternakId.'%');
            }
            if($this->sapiId != null){
                $query->Where('sapi_id','like','%'.$this->sapiId.'%');
            }
        })
        ->get();
        
    }
    public function render()
    {
        return view('livewire.relasi.wire-peternak-sapi',[
            'datas' => $this->resultData(),
            'pendampings' => Pendamping::orderBy('user_id')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak')->get(),
            'sapis' => Sapi::orderBy('generasi')->where('kondisi_lahir' ,'!=', 'Mati')->get(),
        ]);
    }
    public function submit()
    {
        date_default_timezone_set("Asia/Makassar");

        $data = $this->validate();

        $tsr = PendampingPeternak::orderBy('id','DESC')->where('peternak_id', $this->peternak_id)->first();
        $tsr_id = $tsr->tsr_id;
        $penId = $tsr->pendamping_id;

        $data['date'] = now()->format('Y-m-d');
        $data['tsr_id'] = $tsr_id;
        $data['pendamping_id'] = $penId;
        
        if (!$this->selectedItemId) {
            Notifikasi::where('sapi_id', $this->sapi_id)->update([
                'peternak_id' => $this->peternak_id,
                'pendamping_id' => $data['pendamping_id'],
                'tsr_id' => $data['tsr_id'],
            ]);
        }
        Sapi::find($this->sapi_id)->update([
            'peternak_id' => $this->peternak_id,
            'pendamping_id' => $data['pendamping_id'],
            'tsr_id' => $data['tsr_id'],
        ]);
        $save = $this->selectedItemId ?   PeternakSapi::find($this->selectedItemId)->update($data) : PeternakSapi::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");
        $this->cleanVars();  

    }

    public function selectedItem($itemId, $action){

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit(){
        $data = PeternakSapi::find($this->selectedItemId);
        $this->peternak_id = $data->peternak_id;
        $this->sapi_id = $data->sapi_id;
    }
    public function delete(){
        $delete = PeternakSapi::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }

    public function cleanVars(){
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->peternak_id = null;
        $this->sapi_id = null;
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
