<?php

namespace App\Http\Livewire\Sakit;

use App\Exports\MatiExport;
use App\Exports\SapiExport;
use App\Exports\SapiSakitExport;
use App\Models\Notifikasi;
use App\Models\Panen;
use App\Models\Peternak;
use App\Models\Sapi;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class WireMonSakit extends Component
{
    use LivewireAlert;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $sapiId, $peternakId, $pendampingId, $tsrId, $startDate, $endDate, $status;
    public $datax = array(), $dataLabel = array();

    public $rows = "10";
    public $yearNow;

    public $query;
    public $search_results;
    public $how_many;
    public $sapi;
    public $isSakit = true;
    public $selectedItemId;

    protected $listeners = [
        'isSuccess',
        'isError',
        'insert',
        'formFilter',
        'refreshParent'=>'$refresh',
    ];
    public function openSearchModal()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModalSearch');
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
        $this->status = $data['status'];
    }

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        // $this->startDate = now()->subDays(30)->format('Y/m/d');

        $filterTahun = Carbon::now()->year;
        $monthStart = '01';
        $this->startDate = date($filterTahun.'/'.$monthStart.'/01');
        $this->endDate = now()->format('Y/m/d');
        $this->yearNow = $filterTahun;

        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();


    }

    public function render()
    {
        $this->groupData();
        return view('livewire.sakit.wire-mon-sakit',[
            'datas' => $this->resultData(),
        ]);
    }
    public function exportToExcel()
    {
        return Excel::download(new SapiSakitExport($this->resultData()), 'Data Periksa Dokter.xlsx');

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
            if($this->status != null){
                $query->Where('status','like','%'.$this->status.'%');
            }
            
        })
        ->where('role', 2)
        ->latest()
        ->WhereBetween('tanggal',[$this->startDate, $this->endDate])
        ->paginate($this->rows);
    }
    public function dataSapi()
    {
       
        $sapi =  Sapi::orderBy('generasi')
        // ->where('kondisi_lahir' ,'!=', 'Mati')
        ->where('eartag', 'like', '%' . $this->query . '%')
        ->orWhere('generasi', 'like', '%' . $this->query . '%')
        ->orWhere('nama_sapi', 'like', '%' . $this->query . '%')
        ->get();

        // dd(count($sapi));

        $data = Collection::empty();
        foreach ($sapi as $key => $value) {
            if ($value->kondisi_lahir != 'Mati') {
                if ($value->panens->last() != null) {
                    if ($value->panens->last()->role != 1) {
                        $data->push($value);  
                    }
                }else {
                    $data->push($value);  
                }
            }
            
            
        }

        return $data;
    }
    public function groupData()
    {
        $data =  Panen::with('sapi')
        ->whereYear('tanggal', now()->format('Y'))
        ->where('role',2)
        ->orderBy('tanggal')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal)->format('m');
        });

        foreach ($data as $key => $value) {            

            array_push($this->datax, count($value));
            array_push($this->dataLabel, 'Bulan ke - '.$key);
        }
    }
    
    public function updatedQuery() {
        // dd($this->dataSapi());
        $this->search_results = $this->dataSapi()
            ->take($this->how_many);
    }

    public function loadMore() {
        $this->how_many += 5;
        $this->updatedQuery();
    }

    public function resetQuery() {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();
    }
    public function selectSapi($sapiId) {
       $this->isSakit = true;
        $sapi = Sapi::find($sapiId);
        $this->sapi = $sapi;
        $this->triggerConfirm('MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag, 'Sakit');
    }

    public function setSembuh($id, $dataId)
    {
        $this->selectedItemId = $dataId;
       $this->isSakit = false;
       $sapi = Sapi::find($id);
       $this->sapi = $sapi;

       $this->triggerConfirm('MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag,'Sembuh');
    }
    public function insert()
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');


        $peternak = Peternak::find($this->sapi->peternak->id);
        $status = 'Sakit';

        if ($this->isSakit == true) {
            Notifikasi::where('sapi_id',$this->sapi->id)
            ->where('status', 'no')
            ->delete();
        }else {
            $status = 'Sembuh';
            Notifikasi::create([
                'sapi_id' => $this->sapi->id,
                'tanggal' => now()->adddays(1)->format('Y-m-d'),
                'pesan' => "Cek Birahi",
                'keterangan' => '0,0',
                'role' => "0"
            ]);
            Panen::find($this->selectedItemId)->update([
                'keterangan' => 'Sembuh'
            ]);

        }
        

        $data = [
            'tanggal' => $today,
            'status' => $status,
            'keterangan' => $status,
            'role' => 2,
            'sapi_id' => $this->sapi->id,
            'peternak_id' => $this->sapi->peternak->id,
            'pendamping_id' => $peternak->pendamping_id,
            'tsr_id' => $peternak->pendamping->tsr_id,
            'foto' => 'foto'
        ];

        $save = Panen::create($data);
        $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

        $this->sapi = null;
        $this->selectedItemId = null;

    }

    public function triggerConfirm($eartag, $status)
    {
        $this->confirm('Sapi '.$eartag.' '.$status, [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' =>  true, 
            'onConfirmed' => 'insert',
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

}
