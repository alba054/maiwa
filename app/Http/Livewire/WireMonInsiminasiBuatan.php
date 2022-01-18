<?php

namespace App\Http\Livewire;

use App\Exports\IBExport;
use App\Models\InsiminasiBuatan;
use App\Models\Sapi;
use App\Models\Strow;
use App\Models\User;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class WireMonInsiminasiBuatan extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedItemId, $waktu_ib, $dosis_ib, $strow_id, $sapi_id;
    public $startDate, $endDate, $sapiId, $userId, $searchTerm, $strowId, $peternakId, $pendampingId, $tsrId;

    public $datax = array(), $dataLabel = array();
    public $rows = "10";
    public $yearNow;

     protected $rules = [
        'strow_id' => 'required',
        'sapi_id' => 'required',
    ];
    protected $messages = [
        'strow_id.required' => 'this field is required.',
        'sapi_id.required' => 'this field is required.',
    ];
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
        $this->startDate = date($filterTahun.'/'.$monthStart.'/01');
        // $this->startDate = now()->subDays(30)->format('Y/m/d');
        $this->endDate = now()->format('Y/m/d');
        $this->yearNow = $filterTahun;


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
    public function exportToExcel()
    {
        return Excel::download(new IBExport($this->resultData()), 'Insiminasi Buatan.xlsx');

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


    }
    public function resultData()
    {
        // dd("start ".$this->startDate.", end ".$this->endDate);

        $haha = $this->userId;
        return InsiminasiBuatan::with('sapi')
        ->where(function ($query){
            // if($this->searchTerm != ""){
            //     $query->where('metode','like','%'.$this->searchTerm.'%');
            //     $query->orWhere('hasil','like','%'.$this->searchTerm.'%');
                
            // }
            
            if($this->strowId != null){
                $query->Where('strow_id','like','%'.$this->strowId.'%');
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
        
        ->WhereBetween('waktu_ib',[$this->startDate, $this->endDate])
        ->paginate($this->rows);
    }

    public function groupData()
    {
        $data =  InsiminasiBuatan::with('sapi')
        ->whereYear('waktu_ib', now()->format('Y'))
        ->orderBy('waktu_ib')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->waktu_ib)->format('m');
        });

        foreach ($data as $key => $value) {            

            array_push($this->datax, count($value));
            array_push($this->dataLabel, 'Bulan ke - '.$key);
        }

      
    }

    public function render()
    {
        $this->groupData();
        return view('livewire.wire-mon-insiminasi-buatan',[
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get(),
            'strows' => Strow::orderBy('kode_batch','ASC')->get(),
            'insiminasi_buatans' => $this->resultData(),
            'users' => User::where('hak_akses',2)->get()

        ]);
    }
    public function selectedItem($itemId, $action){
        $this->selectedItemId = $itemId;
        if($action == 'delete'){
            $this->triggerConfirm();
        }else if ($action == 'export') {
            return redirect()->to('/export/pkb/3/'.$itemId);
        }else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModalAdd');
        } 
    }
    public function edit(){
        $data = InsiminasiBuatan::find($this->selectedItemId);
        $this->sapi_id = $data->sapi_id;
        $this->strow_id = $data->strow_id;
        $this->waktu_ib = $data->waktu_ib;
        $this->dosis_ib = $data->dosis_ib;
    }

    public function save(){
        date_default_timezone_set("Asia/Makassar");
        $now = now()->format('Y/m/d');
        $data = $this->validate();
        $data['waktu_ib'] = $now;

        $this->selectedItemId ?   $this->update($data) : $this->store($data);    
    }
    public function store($data)
    {
        $save = InsiminasiBuatan::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();   
        
    }
    public function update($data)
    {
        
        $save = InsiminasiBuatan::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();   
    }

    public function delete()
    {
        $delete = InsiminasiBuatan::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }
    public function cleanVars(){
        $this->dispatchBrowserEvent('cleanTgl');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->strow_id = null;
        $this->waktu_ib = null;
        $this->dosis_ib = null;
        $this->foto = null;

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
