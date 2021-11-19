<?php

namespace App\Http\Livewire;

use App\Models\IndukAnak;
use App\Models\Sapi;
use Livewire\Component;

class WireDetailSapi extends Component
{
    public $eartag, $sapi;
    public function mount($sapi)
    {
        // $data = IndukAnak::with(['induk'])
        // ->where('anak_id', $sapi->id)
        // ->first();
        // $data = Sapi::with(['induk'])->get();
        // dd($data);

        // $this->induk = $data;
        $this->eartag = $sapi->eartag;
        $this->sapi = $sapi;
    }
    public function render()
    {
        return view('livewire.wire-detail-sapi');
    }
}
