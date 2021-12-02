<?php

namespace App\Http\Livewire\Panen;

use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use Livewire\Component;

class WireMonPanenSearch extends Component
{
    
    public $startDate, $endDate, $sapiId, $peternakId, $pendampingId, $tsrId, $keterangan, $status;

    public function render()
    {
        return view('livewire.panen.wire-mon-panen-search',[
            'sapis' => Sapi::orderBy('generasi','ASC')->get(),
            'pendampings' => Pendamping::orderBy('id','ASC')->get(),
            'tsrs' => Tsr::orderBy('id','ASC')->get(),
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
            'keterangan' => $this->keterangan,
            'status' => $this->status,
        ];
        $this->emit('formFilter',$data);
        // $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalSearch');
    }
}
