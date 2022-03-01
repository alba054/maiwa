<?php

namespace App\Http\Livewire;

use App\Exports\SapiExport;
use App\Helper\Constcoba;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class WireSapi extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $selectedItemId, $searchTerm, $peternakId, $pendampingId, $tsrId, $sapiId, $jenisSapiId;
    public $startDate, $endDate;

    public $rows = "10";


    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'refreshParent'=>'$refresh',
        'isUpdate',
        'formFilter'
    ];

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");

        $now = now()->format('Y-m-d');
        $filterTahun = Carbon::now()->year;
        $monthStart = '01';

        // $this->startDate = now()->subDays(30)->format('Y/m/d');
        // $this->startDate = date($filterTahun.'/'.$monthStart.'/01');
        // $this->endDate = now()->format('Y/m/d');

        // dd(Constcoba::getStatus());

    }

    public function resultData()
    {
        $penId = $this->pendampingId;
        $tsrId = $this->tsrId;

        $sapi =  Sapi::with(['jenis_sapi','peternak'])
        ->latest()
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('eartag','like','%'.$this->searchTerm.'%');
                $query->orWhere('eartag_induk','like','%'.$this->searchTerm.'%');   
                $query->orWhere('nama_sapi','like','%'.$this->searchTerm.'%');   
                $query->orWhere('kelamin','like','%'.$this->searchTerm.'%');   
                $query->orWhere('tanggal_lahir','like','%'.$this->searchTerm.'%');   
                $query->orWhere('generasi','like','%'.$this->searchTerm.'%');   
                 
            }

            if($this->sapiId != null){
                $query->Where('id','like','%'.$this->sapiId.'%');
            }
            if($this->peternakId != null){
                $query->Where('peternak_id','like','%'.$this->peternakId.'%');
            }
            if($this->jenisSapiId != null){
                $query->Where('jenis_sapi_id','like','%'.$this->jenisSapiId.'%');
            }
        })
        ->whereHas('peternak', function($q) use($penId) {
            if($penId != null){
                $q->where('pendamping_id', $penId);
            }
            
        })
        ->whereHas('peternak.pendamping', function($q) use($tsrId) {
            if($tsrId != null){
                $q->where('tsr_id', $tsrId);
            }
            
        });
        
        if ($this->startDate == null || $this->endDate == null) {
            return $sapi;
        }else {
            return $sapi->WhereBetween('tanggal_lahir',[$this->startDate, $this->endDate]);
        }
        
    }
    
    public function exportToExcel()
    {
        return Excel::download(new SapiExport($this->resultData()->get()), 'sapi.xlsx');

    }
    public function render()
    {
        // dd($this->resultData());
        return view('livewire.wire-sapi',[
            'datas' => $this->resultData()->paginate($this->rows),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get(),
            'pendampings' => Pendamping::orderBy('user_id','ASC')->get()
        ]);
    }

    public function selectedItem($item, $action)
    {
        $this->selectedItemId = $item;

        if($action == 'delete'){
            $this->triggerConfirm();
        } else if($action == 'child'){
            $this->emit('getCreateChild',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModal');
        }else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModal');
        }
    }
    public function delete()
    {
        $path = "public/photos/";
        $path_thumb = "public/photos_thumb/";
        $data = Sapi::find($this->selectedItemId);
        
        $data->pkb()->delete();
        $data->ib()->delete();
        $data->performa()->delete();
        $data->perlakuan()->delete();
        $data->notifikasi()->delete();
        $data->straw()->delete();
        $data->laporans()->delete();
        $data->peternak_sapis()->delete();
        $data->panens()->delete();
        $data->anaks()->delete();
        $data->induk()->delete();



        // $data->statussapi()->delete();

        $delete = Sapi::destroy($this->selectedItemId);
        
        if(Storage::exists($path.$data->foto_depan)){
            Storage::delete([
                $path.$data->foto_depan,
                $path.$data->foto_samping,
                $path.$data->foto_peternak,
                $path.$data->foto_rumah,

                $path_thumb.$data->foto_depan,
                $path_thumb.$data->foto_samping,
                $path_thumb.$data->foto_peternak,
                $path_thumb.$data->foto_rumah,
            ]);
            
        }

        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
    }
    public function create()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModal');
    }
    public function openSearchModal()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModalSearch');
    }

    public function formFilter($data)
    {
        // dd($data);

        $this->startDate = $data['startDate'] == null ? $this->startDate : $data['startDate'];
        $this->endDate = $data['endDate'] == null ? $this->endDate : $data['endDate'];
        $this->sapiId = $data['sapiId'];
        $this->peternakId = $data['peternakId'];
        $this->pendampingId = $data['pendampingId'];
        $this->tsrId = $data['tsrId'];
        $this->jenisSapiId = $data['jenisSapiId'];


    }

     public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        
    }

    public function triggerConfirm()
    {
        $this->confirm('Do you wish to continue ?', [
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
