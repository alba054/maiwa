<?php

namespace App\Http\Controllers;

use App\Models\InsiminasiBuatan;
use App\Models\Panen;
use App\Models\Pendamping;
use App\Models\Performa;
use App\Models\PeriksaKebuntingan;
use App\Models\Perlakuan;
use App\Models\Upah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ExportStrukController extends Controller
{
    public function ExportPKB($statusNo, $id)
    {
        $keterangan = "";
        $jumlah = 0;
        if ($statusNo == "1") {
            $data = PeriksaKebuntingan::find($id);
            $user = Pendamping::with('user')->find($data->pendamping_id);
            $keterangan = "Periksa Kebuntingan";

            $jumlah = Upah::find($statusNo)->price;
            
        } else if ($statusNo == "2") {
            $data = Performa::find($id);
            $user = Pendamping::with('user')->find($data->pendamping_id);
            $keterangan = "Performa (Recording)";

            $jumlah = Upah::find($statusNo)->price;
        } else if ($statusNo == "3") {
            $data = InsiminasiBuatan::find($id);
            $user = Pendamping::with('user')->find($data->pendamping_id);
            $keterangan = "Insiminasi Buatan";

            $jumlah = Upah::find($statusNo)->price;
        }else if ($statusNo == "4") {
            $data = Perlakuan::find($id);
            $user = Pendamping::with('user')->find($data->pendamping_id);
            $keterangan = "Perlakuan Kesehatan";

            $jumlah = Upah::find($statusNo)->price;
        }else if ($statusNo == "5") {
            $data = Panen::find($id);
            $user = Pendamping::with('user')->find($data->pendamping_id);
            $keterangan = "Panen";
            $jumlah = Upah::find($statusNo)->price;
        }
        
    //    return $user;

        setlocale(LC_TIME, 'id_ID');
        \Carbon\Carbon::setLocale('id');
        \Carbon\Carbon::now()->formatLocalized("%A, %d %B %Y");
        $today = Carbon::now()->isoFormat('dddd, D MMMM Y');
        // return $today;
        // return view('pdf.struk',[
        //     'date' => $today,
        //     'keterangan' => $keterangan,
        //     'jumlah' => $jumlah,
        //     'user' => $user
        // ]);
        $pdf = PDF::loadView('pdf.struk',[
            'date' => $today,
            'keterangan' => $keterangan,
            'jumlah' => $jumlah,
            'user' => $user
        ]);

        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('struk.pdf');
    }
}
