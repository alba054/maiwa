<?php

namespace App\Http\Livewire;

use App\Models\Hasil;
use App\Models\Metode;
use App\Models\Pendamping;
use App\Models\PeriksaKebuntingan;
use App\Models\Peternak;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;


class WireMonPeriksaKebuntingan extends Component
{
    public $selectedItemId, $startDate, $endDate, $searchTerm, $sapiId, $peternakId, $pendampingId, $tsrId, $userId, $metodeId, $hasilId;

     protected $rules = [
        'metode_id' => 'required',
        'hasil_id' => 'required',
        'sapi_id' => 'required',
    ];
    protected $messages = [
        
        'metode_id.required' => 'this field is required.',  
        'hasil_id.required' => 'this field is required.',  
        'sapi_id.required' => 'this field is required.',  
    ];

    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'formFilter',
        'refreshParent'=>'$refresh',
    ];

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');
        $this->startDate = now()->subDays(30)->format('Y/m/d');
        $this->endDate = now()->format('Y/m/d');
        $this->waktu_pk = $today;

    }
    public function formFilter($data)
    {
        // dd($data['startDate']);

        $this->startDate = $data['startDate'] == null ? $this->waktu_pk : $data['startDate'];
        $this->endDate = $data['endDate'] == null ? $this->waktu_pk : $data['endDate'];
        
        $this->metodeId = $data['metodeId'];
        $this->hasilId = $data['hasilId'];
        $this->sapiId = $data['sapiId'];
        $this->peternakId = $data['peternakId'];
        $this->pendampingId = $data['pendampingId'];
        $this->tsrId = $data['tsrId'];



    }
    public function formAdd($data)
    {
        // dd($data['startDate']);

        $this->startDate = $data['startDate'] == null ? $this->startDate : $data['startDate'];
        $this->endDate = $data['endDate'] == null ? $this->waktu_pk : $data['endDate'];
        
        $this->metodeId = $data['metodeId'];
        $this->hasilId = $data['hasilId'];
        $this->sapiId = $data['sapiId'];
        $this->peternakId = $data['peternakId'];
        $this->pendampingId = $data['pendampingId'];
        $this->tsrId = $data['tsrId'];



    }
    public function resultData()
    {
        
        // dd("start ".$this->startDate.", end ".$this->endDate);

        $haha = $this->userId;
        return PeriksaKebuntingan::with('sapi')
        ->where(function ($query){
            
            if($this->metodeId != null){
                $query->Where('metode_id',$this->metodeId);
            }
            if($this->hasilId != null){
                $query->Where('hasil_id','like','%'.$this->hasilId.'%');
            }
            if($this->sapiId != null){
                $query->Where('sapi_id','like','%'.$this->sapiId.'%');
            }
            if($this->peternakId != null){
                $query->Where('peternak_id','like','%'.$this->peternakId.'%');
            }
            if($this->pendampingId != null){
                $query->Where('pendamping_id',$this->pendampingId);
            }
            if($this->tsrId != null){
                $query->Where('tsr_id','like','%'.$this->tsrId.'%');
            }
            
        })
        // ->whereHas('sapi.peternak', function($q) use($haha) {
        //     if($haha != null){
        //         $q->where('user_id', $haha);
        //     }
        // })
        ->WhereBetween('waktu_pk',[$this->startDate, $this->endDate])
        ->get();
    }
    public function render()
    {
        return view('livewire.wire-mon-periksa-kebuntingan',[
            'periksa_kebuntingans' => $this->resultData(),
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get(),
            'pendampings' => Pendamping::orderBy('id','ASC')->get(),
            'tsrs' => Tsr::orderBy('id','ASC')->get(),
            'metodes' => Metode::orderBy('metode','ASC')->get(),
            'hasils' => Hasil::orderBy('hasil','ASC')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get(),
        ]);
    }

    public function openSearchModal()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModalSearch');
    }
    public function openAddModal()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModalAdd');
    }

    public function selectedItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;


        if($action == 'delete'){
            $this->triggerConfirm();
        }else if ($action == 'export') {
            return redirect()->to('/export/pkb/1/'.$itemId);
        }else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModalAdd');
        }
        
    }
    public function edit(){
        $data = PeriksaKebuntingan::find($this->selectedItemId);
        $this->sapi_id = $data->sapi_id;
        $this->metode_id = $data->metode_id;
        $this->hasil_id = $data->hasil_id;
    }

    
    public function delete()
    {
        $delete = PeriksaKebuntingan::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }
    public function cleanVars(){
        $this->dispatchBrowserEvent('cleanTgl');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->metode_id = null;
        $this->hasil_id = null;
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
