<?php

namespace App\Http\Livewire\Pkb;

use Livewire\Component;

class WirePkbGrafik extends Component
{
    public $data = 3;
    public function render()
    {
        return view('livewire.pkb.wire-pkb-grafik');
    }
}
