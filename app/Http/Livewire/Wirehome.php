<?php

namespace App\Http\Livewire;

use App\Exports\PopulasiSapiExport;
use App\Models\Laporan;
use App\Models\Notifikasi;
use App\Models\Panen;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\User;
use Carbon\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use SebastianBergmann\Environment\Console;
use Maatwebsite\Excel\Facades\Excel;


class Wirehome extends Component
{
    use WithPagination;
    use LivewireAlert;
    
    protected $paginationTheme = 'bootstrap';

    public $data = [2,4,6];
    public $dataxUpah = array(), $dataLabelUpah = array();
    public $dataxkelahiran = array(), $dataxkematian = array(), $dataxpanen = array();
    public $dataxJantan = array(), $dataxBetina = array(), $dataLabelKelamin = ['01','02', '03', '04','05','06','07','08','09','10','11','12'];

    public $year;

    public function mount()
    {
        // $this->sendFCM();
        date_default_timezone_set("Asia/Makassar");
        // dd(now()->format('Y-m-d H:i:s'));

        // $this->year = now()->format('Y');

    }

    public function sapiData()
    {
        
        $data =  Sapi::with(['jenis_sapi','peternak'])
        ->latest();
        if ($this->year != null) {
            $data = $data->whereYear('tanggal_lahir', $this->year);
        }
        return $data;
        
        
        // ->paginate(10);
    }
    public function allData()
    {
        $this->year = "";
    }
    public function exportToExcel()
    {
        return Excel::download(new PopulasiSapiExport($this->sapiData()->get()), 'populasisapi.xlsx');

    }
    public function render()
    {
        
        date_default_timezone_set("Asia/Makassar");
        // $date = date('Y-m-d : H:i');
        // $data = Notifikasi::orderBy('tanggal', 'ASC')
        // ->WhereBetween('tanggal', [now()->format('Y-m-d'), now()->addDays(30)->format('Y-m-d') ])
        // ->get();

        $this->groupUpah();
        $this->groupKelamin();
        $this->groupSapi();

        $kematian = Panen::where('role', '1')
        ->whereYear('tanggal', $this->year)
        ->get();

        $panen = Panen::where('role', '0')
        ->whereYear('tanggal', $this->year)
        ->get();
        
        $laporans =  Laporan::whereYear('tanggal', $this->year)
        ->orderBy('tanggal');
        

        
        return view('livewire.wirehome',[
            'laporans' => $laporans->get(),
            'laporansPaginate' => $laporans->paginate(5),
            'countPendamping' => count(Pendamping::all()),
            'countPeternak' => count(Peternak::all()),
            'countTsr' => count(Tsr::all()),
            'countSapi' => count($this->sapiData()->get()),
            'countKematian' => count($kematian),
            'countPanen' => count($panen),
            'sapis' => $this->sapiData()->paginate(10, ['*'], '1pagination'),
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
