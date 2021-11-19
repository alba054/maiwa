<?php
namespace App\Http\Livewire;

use App\Models\Performa;
use App\Models\Sapi;
use App\Models\User;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class WireMonPerforma extends Component
{
    use LivewireAlert;

    public $selectedItemId, $tanggal_performa, $tinggi_badan, $berat_badan, $panjang_badan, $lingkar_dada, $bsc, $sapi_id;
    public $startDate, $endDate, $sapiId, $userId, $searchTerm, $peternakId, $pendampingId, $tsrId, $bscId;
    public $datax = array(), $dataLabel = array();

     protected $rules = [
        'tinggi_badan' => 'required',
        'berat_badan' => 'nullable',
        'panjang_badan' => 'required',
        'lingkar_dada' => 'required',
        'bsc' => 'required',
        'sapi_id' => 'required',
    ];
    protected $messages = [
        'tanggal_performa.required' => 'this field is required.',
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
        // dd($this->startDate);
        // $this->startDate = now()->subDays(30)->format('Y/m/d');
        $this->endDate = now()->format('Y/m/d');

    }

    public function formFilter($data)
    {
        // dd($data['startDate']);

        $this->startDate = $data['startDate'] == null ? $this->startDate : $data['startDate'];
        $this->endDate = $data['endDate'] == null ? $this->endDate : $data['endDate'];
        
        $this->bscId = $data['bscId'];
        $this->sapiId = $data['sapiId'];
        $this->peternakId = $data['peternakId'];
        $this->pendampingId = $data['pendampingId'];
        $this->tsrId = $data['tsrId'];


    }

    public function resultData()
    {
        // dd("start ".$this->startDate.", end ".$this->endDate);

        $haha = $this->userId;
        return Performa::with(['sapi','peternak'])
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
            
            if($this->bscId != null){
                $query->Where('bsc','like','%'.$this->bscId.'%');
            }
            
        })
        
        ->WhereBetween('tanggal_performa',[$this->startDate, $this->endDate])
        ->get();
    }
    public function groupData()
    {
        $data =  Performa::with('sapi')
        ->whereYear('tanggal_performa', now()->format('Y'))
        ->orderBy('tanggal_performa')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal_performa)->format('m');
        });

        foreach ($data as $key => $value) {            

            array_push($this->datax, count($value));
            array_push($this->dataLabel, 'Bulan ke - '.$key);
        }

      
    }

    public function render()
    {
        $this->groupData();
        return view('livewire.wire-mon-performa',[
            'sapis' => Sapi::orderBy('nama_sapi','ASC')->get(),
            'perfromas' => $this->resultData(),
            'users' => User::where('hak_akses',2)->get()
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

    public function selectedItem($itemId, $action){
        $this->selectedItemId = $itemId;
        if($action == 'delete'){
            $this->triggerConfirm();
        }else if ($action == 'export') {
            return redirect()->to('/export/pkb/2/'.$itemId);
        }else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModalAdd');
        }
    }
    public function edit(){
        $data = Performa::find($this->selectedItemId);
        $this->sapi_id = $data->sapi_id;
        $this->tanggal_performa = $data->tanggal_performa;
        $this->tinggi_badan = $data->tinggi_badan;
        $this->berat_badan = $data->berat_badan;
        $this->panjang_badan = $data->panjang_badan;
        $this->lingkar_dada = $data->lingkar_dada;
        $this->bsc = $data->bsc;
    }

    public function save(){
        date_default_timezone_set("Asia/Makassar");
        $now = now()->format('Y/m/d');
        $data = $this->validate();
        $data['tanggal_performa'] = $now;
        $this->selectedItemId ?   $this->update($data) : $this->store($data);    
    }
    public function store($data)
    {
        
        $save = Performa::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();   
        
    }
    public function update($data)
    {

        $save = Performa::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->cleanVars();   
    }

    public function delete()
    {
        $delete = Performa::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
        $this->cleanVars();
    }
    public function cleanVars(){
        $this->dispatchBrowserEvent('cleanTgl');

        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->tanggal_performa = null;
        $this->tinggi_badan = null;
        $this->berat_badan = null;
        $this->panjang_badan = null;
        $this->lingkar_dada = null;
        $this->bsc = null;

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
