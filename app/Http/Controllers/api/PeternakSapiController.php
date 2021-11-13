<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Pendamping;
use App\Models\PeternakSapi;
use App\Models\Tsr;
use App\Models\User;
use Illuminate\Http\Request;

class PeternakSapiController extends Controller
{
    public function index($userId)
    {
        $data = [];
        $hak_akses = User::find($userId)->hak_akses;
        if ($hak_akses == 3) {
                
            $pendampingId = Pendamping::where('user_id', $userId)->first()->id;
            $data = PeternakSapi::with(['tsr','pendamping','peternak','sapi'])
            ->where('pendamping_id', $pendampingId)
            ->latest()->get();
        }else{
            $tsrId = Tsr::where('user_id', $userId)->first()->id;
            $data = PeternakSapi::with(['tsr','pendamping','peternak','sapi'])
            ->where('tsr_id', $tsrId)
            ->latest()->get();
        }
        

        return response()->json([
            'responsecode' => '1',
            'responsemsg' => 'Success',
            'peternak_sapi' => $data,
        ], 201);
    }
}
