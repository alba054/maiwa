<?php

namespace App\Http\Livewire;

use App\Exports\PopulasiSapiExport;
use App\Models\Laporan;
use App\Models\Panen;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Environment\Console;

class Wirewelcome extends Component
{
    
    use WithPagination;
    use LivewireAlert;
    
    protected $paginationTheme = 'bootstrap';

    public $data = [2,4,6];
    public $dataxUpah = array(), $dataLabelUpah = array();
    public $dataxkelahiran = array(), $dataxkematian = array(), $dataxpanen = array();
    public $dataxJantan = array(), $dataxBetina = array(), $dataLabelKelamin = ['01','02', '03', '04','05','06','07','08','09','10','11','12'];

    public $year;
    public $tes = 1;

    public function mount()
    {
        // $this->sendFCM();
        // date_default_timezone_set("Asia/Makassar");
        // dd(now()->format('Y-m-d H:i:s'));
        $this->year = now()->format('Y');


    
    }
  
    public function sapiData()
    {
        return Sapi::with(['jenis_sapi','peternak'])
        ->latest()
        ->whereYear('tanggal_lahir', $this->year)
        ->get();
        // ->paginate(10);
    }
    public function exportToExcel()
    {
        return Excel::download(new PopulasiSapiExport($this->sapiData()), 'populasisapi.xlsx');

    }
    public function render()
    {
        
        date_default_timezone_set("Asia/Makassar");
        
        $this->groupKelamin();
        $this->groupSapi();
        $this->groupUpah();

        $kematian = Panen::where('role', '1')
        ->whereYear('tanggal', $this->year)
        ->get();

        $panen = Panen::where('role', '0')
        ->whereYear('tanggal', $this->year)
        ->get();
        
        $laporans =  Laporan::whereYear('tanggal', $this->year)
        ->orderBy('tanggal')
        ->get();

       

        $this->tes = count($this->sapiData());

        return view('livewire.wirewelcome',[
            'laporans' => $laporans,
            'countPendamping' => count(Pendamping::all()),
            'countPeternak' => count(Peternak::all()),
            'countTsr' => count(Tsr::all()),
            'countSapi' => count($this->sapiData()),
            'countKematian' => count($kematian),
            'countPanen' => count($panen),
            'sapis' => $this->sapiData(),
        ]);
    }

   
    public function groupUpah()
    {
        $this->dataxUpah = [];
        $this->dataLabelUpah = [];
        $data =  Laporan::whereYear('tanggal', $this->year)
        ->orderBy('tanggal')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal)->format('m');
        });

        foreach ($data as $key => $value) {            
            array_push($this->dataxUpah, count($value));
            array_push($this->dataLabelUpah, $key);
        }

        
    }
    public function groupKelamin()
    {
        $this->dataxJantan = [];
        $this->dataxBetina = [];
        $dataJantan =  Sapi::where('kelamin', 'Jantan')
        ->whereYear('tanggal_lahir', $this->year)
        ->orderBy('tanggal_lahir')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal_lahir)->format('m');
        });

        $dataBetina =  Sapi::where('kelamin', 'Betina')
        ->whereYear('tanggal_lahir', $this->year)
        ->orderBy('tanggal_lahir')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal_lahir)->format('m');
        });

        foreach ($this->dataLabelKelamin as $key => $valueLabel) {
            if ($dataJantan->has($valueLabel)) {
                $jantan = $dataJantan[$valueLabel];
                array_push($this->dataxJantan, count($jantan));
            }else{
                array_push($this->dataxJantan, 0);

            }
            if ($dataBetina->has($valueLabel)) {
                $betina = $dataBetina[$valueLabel];
                array_push($this->dataxBetina, count($betina));
            }else{
                array_push($this->dataxBetina, 0);

            }   
        }
    }

    public function groupSapi()
    {
        $this->dataxkelahiran = [];
        $this->dataxkematian = [];
        $this->dataxpanen = [];

        $dataKelahiran =  Sapi::orderBy('tanggal_lahir')
        ->whereYear('tanggal_lahir', $this->year)
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal_lahir)->format('m');
        });
        $dataKematian =  Panen::where('role', '1')
        ->whereYear('tanggal', $this->year)
        ->orderBy('tanggal')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal)->format('m');
        });
        $dataPanen =  Panen::where('role', '0')
        ->whereYear('tanggal', $this->year)
        ->orderBy('tanggal')
        ->get()
        ->groupBy(function($val) {
            return Carbon::parse($val->tanggal)->format('m');
        });
        // dd($dataPanen);

        foreach ($this->dataLabelKelamin as $key => $valueLabel) {
            if ($dataKelahiran->has($valueLabel)) {
                $jantan = $dataKelahiran[$valueLabel];
                array_push($this->dataxkelahiran, count($jantan));
            }else{
                array_push($this->dataxkelahiran, 0);

            }

            if ($dataKematian->has($valueLabel)) {
                $kematian = $dataKematian[$valueLabel];
                array_push($this->dataxkematian, count($kematian));
            }else{
                array_push($this->dataxkematian, 0);

            }
            if ($dataPanen->has($valueLabel)) {
                $panen = $dataPanen[$valueLabel];
                array_push($this->dataxpanen, count($panen));
            }else{
                array_push($this->dataxpanen, 0);

            }
            
        }
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

    
}
