<?php

namespace App\Http\Livewire;

use App\Exports\PerlakuanExport;
use App\Models\Hormon;
use App\Models\Obat;
use App\Models\Perlakuan;
use App\Models\Sapi;
use App\Models\User;
use App\Models\Vaksin;
use App\Models\Vitamin;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class WireMonPerlakuan extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedItemId;
    public $startDate, $endDate, $sapiId, $peternakId, $pendampingId, $tsrId, $obatId, $vitaminId, $vaksinId, $hormonId;
    public $datax = array(), $dataLabel = array();
    public $rows = "10";
    public $yearNow;


    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'refreshParent'=>'$refresh',
        'formFilter'
    ];

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        $filterTahun = Carbon::now()->year;
        $monthStart = '01';

        // $this->startDate = now()->subDays(30)->format('Y/m/d');
        $this->startDate = date($filterTahun.'/'.$monthStart.'/01');
        $this->endDate = now()->format('Y/m/d');

        $this->yearNow = $filterTahun;

    }
    public function openSearchModal()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModalSearch');
    }

    public function exportToExcel()
    {
        return Excel::download(new PerlakuanExport($this->resultData()), 'Perlakuan Kesehatan.xlsx');

    }
    public function formFilter($data)
    {
        // dd($data['startDate']);

        $this->startDate = $data['startDate'] == null ? $this->startDate : $data['startDate'];
        $this->endDate = $data['endDate'] == null ? $this->endDate : $data['endDate'];
        
        $this->obatId = $data['obatId'];
        $this->sapiId = $data['sapiId'];
        $this->peternakId = $data['peternakId'];
        $this->pendampingId = $data['pendampingId'];
        $this->tsrId = $data['tsrId'];
        $this->vitaminId = $data['vitaminId'];
        $this->vaksinId = $data['vaksinId'];
        $this->hormonId = $data['hormonId'];


    }

    public function resultData()
    {
        // dd("start ".$this->startDate.", end ".$this->endDate);

        return Perlakuan::with('sapi')
        ->where(function ($query){
            // if($this->searchTerm != ""){
            //     $query->where('metode','like','%'.$this->searchTerm.'%');
            //     $query->orWhere('hasil','like','%'.$this->searchTerm.'%');
                
            // }
            if($this->sapiId != null){
                $query->Where('sapi_id','like','%'.$this->sapiId.'%');
            }
            if($this->obatId != null){
                $query->Where('obat_id','like','%'.$this->obatId.'%');
            }
            if($this->vitaminId != null){
                $query->Where('vitamin_id','like','%'.$this->vitaminId.'%');
            }
            if($this->vaksinId != null){
                $query->Where('vaksin_id','like','%'.$this->vaksinId.'%');
            }
            if($this->hormonId != null){
                $query->Where('hormon_id','like','%'.$this->hormonId.'%');
            }
            if($this->peternakId != null){
                $query->Where('peternak_id','like','%'.$this->peternakId.'%');
            }
            if($this->pendampingId != null){
                $query->Where('pendamping_id','like','%'.$this->pendampingId.'%');
            }
            if($this->tsrId != null){
                $query->Where('tsr_id','like','%'.$this->tsrId.'%');
            }
            
            
        })
        
        ->WhereBetween('tgl_perlakuan',[$this->startDate, $this->endDate])
        ->paginate($this->rows);
    }

    public function groupData()
    {
        $data =  Perlakuan::with('sapi')
        ->whereYear('tgl_perlakuan', now()->format('Y'))
        ->orderBy('tgl_perlakuan')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tgl_perlakuan)->format('m');
        });

        foreach ($data as $key => $value) {            

            array_push($this->datax, count($value));
            array_push($this->dataLabel, 'Bulan ke - '.$key);
        }

      
    }
    public function render()
    {
        $this->groupData();
        return view('livewire.wire-mon-perlakuan',[
            'perlakuans' => $this->resultData(),
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get(),
            'users' => User::where('hak_akses',2)->get(),
            
        ]);
    }

    public function create()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModal');
    }

    public function selectedItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;

        if($action == 'delete'){
            $this->triggerConfirm();
        }else if ($action == 'export') {
            return redirect()->to('/export/pkb/4/'.$itemId);
        } else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModal');
        }
        
    }
   
    public function delete()
    {
        
        $delete = Perlakuan::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();   
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
