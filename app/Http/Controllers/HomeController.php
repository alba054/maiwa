<?php

namespace App\Http\Controllers;

use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Post;
use App\Models\Sapi;
use App\Models\Tsr;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $year;

    public function __construct()
    {
        // $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        $this->year = now()->format('Y');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',[
            'countPendamping' => count(Pendamping::all()),
            'countPeternak' => count(Peternak::all()),
            'countTsr' => count(Tsr::all()),
            'countSapi' => count(Sapi::all()),
        ]);
    }
    public function welcome()
    {
        return view('welcome',[
            'datas' => Post::latest()->paginate(3),
            'year' => $this->year,
            'sapis' => $this->sapiData(),
        ]);
    }

    public function sapiData()
    {
        return Sapi::with(['jenis_sapi','peternak'])
        ->latest()
        ->whereYear('tanggal_lahir', $this->year)
        // ->get();
        ->paginate(10);
    }
}
