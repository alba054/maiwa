<?php

namespace App\Http\Livewire;

use App\Models\Notifikasi;
use Livewire\Component;
use App\Helper\Constcoba;


class Wirenotifikasi extends Component
{
    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        // dd(now()->adddays(1)->format('Y-m-d'));
        
        $data = Notifikasi::with(['sapi'])
        ->orderBy('tanggal', 'ASC')
        // ->whereDate('tanggal',now()->subdays(1)->format('Y-m-d'))
        ->where('status','no')
        ->WhereBetween('tanggal', [now()->subdays(1)->format('Y-m-d'), now()->format('Y-m-d')])
        ->get();
        // dd($data);
        // return $data;
        // echo(now()->format('Y-m-d'));

        foreach ($data as $key => $value) {
            $token = $value->sapi->peternak->pendamping->user->remember_token;
            // dd($token);
            // echo($token.'<br/>');
            $pesan = $value->pesan.' ke Sapi '.$value->sapi->eartag;

            $this->sendFCM($token, 'MBC', $pesan);
            // Constcoba::sendFCM($token, 'MBC', $pesan, $value->role.','.$value->sapi->peternak->pendamping->user->id);
        }
    }
    public function render()
    {
        return view('livewire.wirenotifikasi',[
            'datas' => Notifikasi::orderBy('tanggal')->get()
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
