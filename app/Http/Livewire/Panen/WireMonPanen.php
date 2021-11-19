<?php

namespace App\Http\Livewire\Panen;

use App\Models\Panen;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class WireMonPanen extends Component
{
    use LivewireAlert;
    public $sapiId, $peternakId, $pendampingId, $tsrId, $startDate, $endDate, $frekPanen, $ketPanen;
    public $datax = array(), $dataLabel = array();

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
        // $this->startDate = now()->subDays(30)->format('Y/m/d');

        $filterTahun = Carbon::now()->year;
        $monthStart = '01';
        $this->startDate = date($filterTahun.'/'.$monthStart.'/01');
        $this->endDate = now()->format('Y/m/d');

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

    public function resultData()
    {

        return Panen::with('sapi')
        ->where(function ($query){
            // if($this->searchTerm != ""){
            //     $query->where('metode','like','%'.$this->searchTerm.'%');
            //     $query->orWhere('hasil','like','%'.$this->searchTerm.'%');
                
            // }
            
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
            if($this->frekPanen != null){
                $query->Where('frek_panen','like','%'.$this->frekPanen.'%');
            }
            if($this->ketPanen != null){
                $query->Where('ket_panen','like','%'.$this->ketPanen.'%');
            }
            
        })
        
        ->WhereBetween('tgl_panen',[$this->startDate, $this->endDate])
        ->get();
    }

    public function groupData()
    {
        $data =  Panen::with('sapi')
        ->whereYear('tgl_panen', now()->format('Y'))
        ->orderBy('tgl_panen')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tgl_panen)->format('m');
        });

        foreach ($data as $key => $value) {            

            array_push($this->datax, count($value));
            array_push($this->dataLabel, 'Bulan ke - '.$key);
        }

      
    }
    public function render()
    {
        $this->groupData();
        return view('livewire.panen.wire-mon-panen',[
            'datas' => $this->resultData(),
        ]);
    }
    public function formFilter($data)
    {
        // dd($data['startDate']);

        $this->startDate = $data['startDate'] == null ? $this->startDate : $data['startDate'];
        $this->endDate = $data['endDate'] == null ? $this->endDate : $data['endDate'];
        $this->sapiId = $data['sapiId'];
        $this->peternakId = $data['peternakId'];
        $this->pendampingId = $data['pendampingId'];
        $this->tsrId = $data['tsrId'];
        $this->ketPanen = $data['ketPanen'];
        $this->frekPanen = $data['frekPanen'];


    }

    public function selectedItem($itemId, $action){
        $this->selectedItemId = $itemId;
        if($action == 'delete'){
            $this->triggerConfirm();
        }else if ($action == 'export') {
            return redirect()->to('/export/pkb/5/'.$itemId);
        }else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModalAdd');
        } 
    }

    public function delete()
    {
        $delete = Panen::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
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
