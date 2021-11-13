<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WireDetailSapi extends Component
{
    public $eartag, $sapi;
    public function mount($sapi)
    {
        // dd($sapi);

        $this->eartag = $sapi->eartag;
        $this->sapi = $sapi;
    }
    public function render()
    {
        return view('livewire.wire-detail-sapi');
    }
}
