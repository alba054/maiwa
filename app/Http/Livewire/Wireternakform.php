<?php

namespace App\Http\Livewire;

use App\Models\Peternak;
use Livewire\Component;
use Livewire\WithFileUploads;

class Wireternakform extends Component
{
    use WithFileUploads;
    public $peternak_id, $photo_depan, $photo_belakang, $photo_kiri, $photo_kanan, $kode, $name, $induk, $ertag, $tgl_lahir, $kelamin, $jenis, $status;

    public function render()
    {
        return view('livewire.wireternakform',[
            // 'peternaks' => Peternak::orderBy('name','ASC')->get()
        ]);
    }
}
