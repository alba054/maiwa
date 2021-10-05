<?php
namespace App\Http\Livewire\Notif;

use Livewire\Component;
use App\Helper\Constcoba;
use App\Models\Notifikasi;
use App\Models\Sapi;
use App\Models\User;
use SebastianBergmann\Environment\Console;

class Generate extends Component
{
    protected $notif = array ();
    protected $today;

    public function mount()
    {
        $data = Notifikasi::with('sapi')
        ->orderBy('tanggal', 'ASC')
        ->WhereBetween('tanggal', [now()->subdays(7)->format('Y-m-d'), now()->format('Y-m-d')])
        ->get();
        // return $data;
        // echo(now()->format('Y-m-d'));

        foreach ($data as $key => $value) {
            $token = $value->sapi->peternak->user->remember_token;
            // dd($token);
            // echo($token.'<br/>');
            $pesan = $value->pesan.' ke Sapi '.$value->sapi->ertag;
            $this->sendFCM($token, 'MBC', $pesan);
        }
    }

    public function resultData()
    {
        return Notifikasi::allnotif(null);
    }
    public function render()
    {
        // dd($this->resultData());
        return view('livewire.notif.generate',[
            'notifs' => $this->resultData(),
        ]);
    }

    public function generate()
    {
        date_default_timezone_set("Asia/Makassar");

        $vitamin 		= Constcoba::nilai_vitamin;
        $anti_biotik 	= Constcoba::nilai_anti_biotik;
        $obat_cacing 	= Constcoba::nilai_obat_cacing;
        $recording 		= Constcoba::nilai_recording;

        Notifikasi::truncate();
        
        $sapis = Sapi::with('peternak')->get();
        
        foreach ($sapis as $key => $value) {
            
            $this->notif($value->tanggal_lahir, $vitamin, Constcoba::VITAMIN, 'Pendamping', $value);
            $this->notif($value->tanggal_lahir, $anti_biotik, Constcoba::BIOTIK, 'Pendamping', $value);
            $this->notif($value->tanggal_lahir, $obat_cacing, Constcoba::CACING, 'Pendamping', $value);
            $this->notif($value->tanggal_lahir, $recording, Constcoba::RECORDING, 'Pendamping', $value);

        }
        sort($this->notif);
        // dd($this->notif);
        $this->isSuccess('generate success');
    }

    function notif($tgl, $array, $teks, $penerima, $sapi){
	    $s=0;//selisih
        for ($i=0; $i < count($array); $i++) {
            $s = ($i>0) ? ($array[$i]-$array[$i-1])*30 : $array[$i]*30 ;
            $tgl.=' + '.$s.' days';
            array_push($this->notif,array(date('Y-m-d', strtotime($tgl)),$teks,$penerima, $sapi));
            Notifikasi::create([
                'sapi_id' => $sapi->id,
                'tanggal' => date('Y-m-d', strtotime($tgl)),
                'pesan' => $teks,
            ]);
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

                "sound"=> "default" // required for sound on ios

            ],

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

    
