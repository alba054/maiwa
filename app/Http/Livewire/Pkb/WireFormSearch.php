<?php

namespace App\Http\Livewire\Pkb;

use App\Models\Hasil;
use App\Models\Metode;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use Livewire\Component;

class WireFormSearch extends Component
{
    public $sapiId, $peternakId, $pendampingId, $tsrId, $userId, $metodeId, $hasilId;
    public $startDate, $endDate;
    
    public function render()
    {
        return view('livewire.pkb.wire-form-search',[
            'sapis' => Sapi::orderBy('generasi','ASC')->get(),
            'pendampings' => Pendamping::orderBy('id','ASC')->get(),
            'tsrs' => Tsr::orderBy('id','ASC')->get(),
            'metodes' => Metode::orderBy('metode','ASC')->get(),
            'hasils' => Hasil::orderBy('hasil','ASC')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get(),
        ]);
    }

    public function submit()
    {
        $data = [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'sapiId' => $this->sapiId,
            'peternakId' => $this->peternakId,
            'pendampingId' => $this->pendampingId,
            'tsrId' => $this->tsrId,
            'metodeId' => $this->metodeId,
            'hasilId' => $this->hasilId,
        ];
        $this->emit('formFilter',$data);
        // $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalSearch');
    }
}
