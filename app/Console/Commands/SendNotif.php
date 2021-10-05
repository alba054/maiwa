<?php

namespace App\Console\Commands;

use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Console\Command;

class SendNotif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set("Asia/Makassar");
        // $date = date('Y-m-d : H:i');
        $today = date('Y/m/d');
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
