<?php
 
namespace App\Helper;

class Constcoba{
    const VITAMIN = 'Berikan Vitamin, Obat, Vaksin, Hormon';
    const BIOTIK = 'Berikan anti biotik';
    const CACING = 'Berikan obat cacing';
    const RECORDING = 'Recording/performa';
    const BIRAHI = 'Cek Birahi';
    const PANEN = 'Panen';

    const nilai_vitamin = array(3,6,18,21,25);
    const nilai_anti_biotik = array(21,25);
    const nilai_obat_cacing = array(3,6,18,21,25);
    const nilai_recording = array(6,21);
    const nilai_birahi = array(2);
    const nilai_panen = array(18,24);

    static public function sendFCM($token, $title, $body, $role)
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
                "event" => $role
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