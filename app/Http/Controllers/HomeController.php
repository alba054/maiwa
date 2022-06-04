<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Panen;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Post;
use App\Models\Sapi;
use App\Models\Tsr;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    protected $paginationTheme = 'bootstrap';

    public $year;
    public $dataxkelahiran = array(), $dataxkematian = array(), $dataxpanen = array();
    public $dataxjantan = array(), $dataxbetina = array();
    public $dataxupah = array();
    public $countSapi, $countKematian, $countPanen, $labelSapi;
    public $dataLabelBulan = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

    public function __construct()
    {
        // $this->middleware('auth');
        date_default_timezone_set("Asia/Makassar");
        // $this->year = '2022';
    }

    public function filter(Request $request)
    {
        $this->year = $request->year;
        // return $this->year;

        $this->groupSapi();

        return redirect()->route('home', $this->year);
    }
    public function index($year = 0)
    {
        if ($year != 0) {
            $this->year = $year;
        }
        $this->groupSapi();
        // return $this->dataxkelahiran;
        return view('home', [
            'countPendamping' => count(Pendamping::all()),
            'countPeternak' => count(Peternak::all()),
            'countTsr' => count(Tsr::all()),
            'countSapi' => $this->countSapi,
            'countKematian' => $this->countKematian,
            'countPanen' => $this->countPanen,
            'labelSapi' => $this->labelSapi,
            'dataxkelahiran' => $this->dataxkelahiran,
            'dataxkematian' => $this->dataxkematian,
            'dataxpanen' => $this->dataxpanen,
            'dataxjantan' => $this->dataxjantan,
            'dataxbetina' => $this->dataxbetina,
            'dataxupah' => $this->dataxupah,
            'year' => $this->year,
            'laporansPaginate' => $this->laporanData()->get(),
            'yearSelected' => $this->year,
            'sapis' => $this->sapiData()->paginate(10, ['*'], '1pagination'),
            'sapisKelamin' => $this->sapiData()->get(),
            'countPendamping' => count(Pendamping::all()),


        ]);
    }
    public function welcome()
    {
        return view('welcome', [
            'datas' => Post::latest()->paginate(3),
            'year' => $this->year,
            'sapis' => $this->sapiData(),
        ]);
    }

    public function sapiData()
    {
        $data =  Sapi::with(['jenis_sapi', 'peternak'])
            ->orderBy('tanggal_lahir');
        if ($this->year != null) {
            $data = $data->whereYear('tanggal_lahir', $this->year);
        }
        return $data;
    }
    public function panenData($role = '1')
    {
        $data =  Panen::where('role', $role)
            ->orderBy('tanggal');
        if ($this->year != null) {
            $data = $data->whereYear('tanggal', $this->year);
        }
        return $data;
    }

    public function laporanData()
    {
        return Laporan::orderBy('tanggal')->where(function ($query) {

            if ($this->year != null) {
                $query->whereYear('tanggal', $this->year);
            }
        });
    }

    public function groupSapi()
    {
        $this->dataxkelahiran = [];
        $this->dataxkematian = [];
        $this->dataxpanen = [];

        $this->dataxjantan = [];
        $this->dataxbetina = [];

        $this->dataxupah = [];

        $this->labelSapi = [];

        $dataKelahiran = $this->sapiData()->get();
        $dataKematian =  $this->panenData('1')->get();
        $dataPanen =  $this->panenData('0')->get();

        $dataJantan = $this->sapiData()->where('kelamin', 'Jantan')->get();
        $dataBetina = $this->sapiData()->where('kelamin', 'Betina')->get();

        $dataUpah = $this->laporanData()->get();

        $this->countSapi = count($dataKelahiran);
        $this->countKematian = count($dataKematian);
        $this->countPanen = count($dataPanen);

        if ($this->year) {
            $this->labelSapi = $this->dataLabelBulan;

            $dataKelahiran = $dataKelahiran->groupBy(function ($val) {
                return Carbon::parse($val->tanggal_lahir)->format('m');
            });
            $dataKematian = $dataKematian->groupBy(function ($val) {
                return Carbon::parse($val->tanggal)->format('m');
            });
            $dataPanen = $dataPanen->groupBy(function ($val) {
                return Carbon::parse($val->tanggal)->format('m');
            });

            $dataJantan = $dataJantan->groupBy(function ($val) {
                return Carbon::parse($val->tanggal_lahir)->format('m');
            });
            $dataBetina = $dataBetina->groupBy(function ($val) {
                return Carbon::parse($val->tanggal_lahir)->format('m');
            });
            $dataUpah = $dataUpah->groupBy(function ($val) {
                return Carbon::parse($val->tanggal)->format('m');
            });

            foreach ($this->dataLabelBulan as $key => $valueLabel) {

                if ($dataKelahiran->has($valueLabel)) {
                    $lahir = $dataKelahiran[$valueLabel];
                    array_push($this->dataxkelahiran, count($lahir));
                } else {
                    array_push($this->dataxkelahiran, 0);
                }

                if ($dataKematian->has($valueLabel)) {
                    $kematian = $dataKematian[$valueLabel];
                    array_push($this->dataxkematian, count($kematian));
                } else {
                    array_push($this->dataxkematian, 0);
                }

                if ($dataPanen->has($valueLabel)) {
                    $panen = $dataPanen[$valueLabel];
                    array_push($this->dataxpanen, count($panen));
                } else {
                    array_push($this->dataxpanen, 0);
                }
                if ($dataJantan->has($valueLabel)) {
                    $jantan = $dataJantan[$valueLabel];
                    array_push($this->dataxjantan, count($jantan));
                } else {
                    array_push($this->dataxjantan, 0);
                }
                if ($dataBetina->has($valueLabel)) {
                    $betina = $dataBetina[$valueLabel];
                    array_push($this->dataxbetina, count($betina));
                } else {
                    array_push($this->dataxbetina, 0);
                }
                if ($dataUpah->has($valueLabel)) {
                    $upah = $dataUpah[$valueLabel];
                    array_push($this->dataxupah, count($upah));
                } else {
                    array_push($this->dataxupah, 0);
                }
            }
        } else {
            $year = now()->format('Y');

            $dataKelahiran = $dataKelahiran->groupBy(function ($val) {
                return Carbon::parse($val->tanggal_lahir)->format('Y');
            });
            $dataKematian = $dataKematian->groupBy(function ($val) {
                return Carbon::parse($val->tanggal)->format('Y');
            });
            $dataPanen = $dataPanen->groupBy(function ($val) {
                return Carbon::parse($val->tanggal)->format('Y');
            });

            $dataJantan = $dataJantan->groupBy(function ($val) {
                return Carbon::parse($val->tanggal_lahir)->format('Y');
            });
            $dataBetina = $dataBetina->groupBy(function ($val) {
                return Carbon::parse($val->tanggal_lahir)->format('Y');
            });
            $dataUpah = $dataUpah->groupBy(function ($val) {
                return Carbon::parse($val->tanggal)->format('Y');
            });

            for ($i = $year - 10; $i <= $year; $i++) {
                array_push($this->labelSapi, $i);


                if ($dataKematian->has($i)) {
                    $kematian = $dataKematian[$i];
                    array_push($this->dataxkematian, count($kematian));
                } else {
                    array_push($this->dataxkematian, 0);
                }

                if ($dataKelahiran->has($i)) {
                    $lahir = $dataKelahiran[$i];
                    array_push($this->dataxkelahiran, count($lahir));
                } else {
                    array_push($this->dataxkelahiran, 0);
                }
                if ($dataPanen->has($i)) {
                    $panen = $dataPanen[$i];
                    array_push($this->dataxpanen, count($panen) * 10);
                } else {
                    array_push($this->dataxpanen, 0);
                }
                if ($dataJantan->has($i)) {
                    $jantan = $dataJantan[$i];
                    array_push($this->dataxjantan, count($jantan));
                } else {
                    array_push($this->dataxjantan, 0);
                }
                if ($dataBetina->has($i)) {
                    $betina = $dataBetina[$i];
                    array_push($this->dataxbetina, count($betina));
                } else {
                    array_push($this->dataxbetina, 0);
                }
                if ($dataUpah->has($i)) {
                    $upah = $dataUpah[$i];
                    array_push($this->dataxupah, count($upah));
                } else {
                    array_push($this->dataxupah, 0);
                }
            }
        }



        // return $this->dataxkelahiran;
    }
}
