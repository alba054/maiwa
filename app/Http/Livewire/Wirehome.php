<?php

namespace App\Http\Livewire;

use App\Exports\PopulasiSapiExport;
use App\Models\Laporan;
use App\Models\Notifikasi;
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

    public function mount()
    {
        // $this->sendFCM();
        // date_default_timezone_set("Asia/Makassar");
        // dd(now()->format('Y-m-d H:i:s'));
    }

    public function sapiData()
    {
        return Sapi::with(['jenis_sapi','peternak','status_sapi'])
        ->latest()
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
        // $date = date('Y-m-d : H:i');
        // $data = Notifikasi::orderBy('tanggal', 'ASC')
        // ->WhereBetween('tanggal', [now()->format('Y-m-d'), now()->addDays(30)->format('Y-m-d') ])
        // ->get();

        

        return view('livewire.wirehome',[
            'laporans' => Laporan::latest()->get(),
            'countPendamping' => count(Pendamping::all()),
            'countPeternak' => count(Peternak::all()),
            'countTsr' => count(Tsr::all()),
            'countSapi' => count(Sapi::all()),
            'sapis' => $this->sapiData(),
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

    
}
