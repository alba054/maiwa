<?php

namespace App\Http\Livewire;

use App\Exports\NotifikasiExport;
use App\Models\Notifikasi;
use Livewire\Component;
use App\Helper\Constcoba;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class Wirenotifikasi extends Component
{
    public $sapiId, $peternakId, $pendampingId, $tsrId;
    public $startDate, $endDate;
    public $status, $searchTerm;

    protected $listeners = [
        
        'refreshParent'=>'$refresh',
        'formFilter'
    ];
    
    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");

        $now = now()->format('Y-m-d');
        $filterTahun = Carbon::now()->year;
        $monthStart = '01';
        $monthEnd = '12';

        // $this->startDate = now()->subDays(30)->format('Y/m/d');
        $this->startDate = date($filterTahun.'-'.$monthStart.'-01');
        $this->endDate = date($filterTahun.'-'.$monthEnd.'-01');
        
        
        $data = Notifikasi::with(['sapi'])
            ->orderBy('tanggal', 'ASC')
            ->where('tanggal', '>=', now()->subdays(7)->format('Y-m-d'))
            ->where('status', 'no')
            ->get();

            // dd($data);

        $array_tanggal = [];
        foreach ($data as $key => $value) {
            $token = $value->sapi->peternak->pendamping->user->remember_token;

            if ($value->role == "0" && $value->tanggal <= now()->format('Y-m-d')) {
                $bday = Carbon::parse($value->tanggal);
                $diff = fmod($bday->diffInDays($now), 7);

                // dd($diff);
                // array_push($array_tanggal, $value->pesan);

                if ($diff == 0.0) {
                    
                    $pesan = $value->pesan.' ke Sapi '.'MBC-' . $value->sapi->generasi . '.' . $value->sapi->anak_ke . '-' . $value->sapi->eartag_induk . '-' . $value->sapi->eartag;
                    $this->sendFCM($token, 'MBC', $pesan);

                }
            }else {

                if ($value->tanggal == now()->format('Y-m-d') ) {
                    // array_push($array_tanggal, $value->pesan);
                    $pesan = $value->pesan.' Hari ini ke Sapi '.'MBC-' . $value->sapi->generasi . '.' . $value->sapi->anak_ke . '-' . $value->sapi->eartag_induk . '-' . $value->sapi->eartag;
                    $this->sendFCM($token, 'MBC', $pesan);
                    
                }else if ($value->tanggal == now()->adddays(1)->format('Y-m-d')) {
                    $pesan = $value->pesan.' Esok Hari ke Sapi '.'MBC-' . $value->sapi->generasi . '.' . $value->sapi->anak_ke . '-' . $value->sapi->eartag_induk . '-' . $value->sapi->eartag;
                    $this->sendFCM($token, 'MBC', $pesan);
                    
                }

            }
            
        //     // dd($token);
        //     // echo($token.'<br/>');
        //     //

            
            // Constcoba::sendFCM($token, 'MBC', $pesan, $value->role.','.$value->sapi->peternak->pendamping->user->id);
        }
        // // dd($array_tanggal);


    }

    public function resultData()
    {
        $peterId = $this->peternakId;
        $penId = $this->pendampingId;
        $tsrId = $this->tsrId;

        return Notifikasi::with('sapi')
        ->orderBy('tanggal')
        ->where(function ($query){
           
            if($this->searchTerm != ""){
                $query->where('pesan','like','%'.$this->searchTerm.'%');
                
                 
            }

            if($this->sapiId != null){
                $query->Where('sapi_id','like','%'.$this->sapiId.'%');
            }
            if($this->status != null){
                $query->Where('status','like','%'.$this->status.'%');
            }
            
 
        })
        ->whereHas('sapi', function($q) use($peterId) {
            if($peterId != null){
                $q->where('peternak_id', $peterId);
            }
            
        })
        ->whereHas('sapi.peternak', function($q) use($penId) {
            if($penId != null){
                $q->where('pendamping_id', $penId);
            }
            
        })
        ->whereHas('sapi.peternak.pendamping', function($q) use($tsrId) {
            if($tsrId != null){
                $q->where('tsr_id', $tsrId);
            }
            
        })
        ->WhereBetween('tanggal',[$this->startDate, $this->endDate])

        ->get();
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
        $this->status = $data['status'];


    }

    public function openSearchModal()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModalSearch');
    }

    public function exportToExcel()
    {
        return Excel::download(new NotifikasiExport($this->resultData()), 'Data Notifikasi.xlsx');

    }
    public function render()
    {
        // dd($this->resultData());
        return view('livewire.wirenotifikasi',[
            'datas' => $this->resultData()
        ]);
    }
    public function sendFCM($token, $title, $body)
    {
        $SERVER_API_KEY = "AAAAXIxpSbY:APA91bEQ__NawWw36uFJA5BakyFdXYAEoolgzrIPhsfFhF0PzH978EY-FDYGE6Qbqaoqcs3LRRuwjIHX2-LCRwQMKYloWMqPYxhtRxV9E4OH9cR-tjivKq9FdXTpjx9vYtlwwRtQ4suX";
        
        // $token = [];
        // $dataUser = User::where('hak_akses', '2')->get();
        // foreach ($dataUser as $key => $value) {
        //     $token[$key] = $value->remember_token;
        // }

        // dd($token);

        $data = [

            "registration_ids" => 
                [$token],
            

            "notification" => [

                "title" => $title,

                "body" => $body,

                "sound"=> "default", // required for sound on ios

               

            ],
            "data" => [
                "event" => "2,".$title
            ]

        ];

    $dataString = json_encode($data);

    $headers = [

        'Authorization: key=' . $SERVER_API_KEY,

        'Content-Type: application/json',

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    // dd($response);
    }
}
