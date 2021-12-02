<?php

namespace App\Http\Livewire\Notif;

use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use Livewire\Component;

class WireNotifSearch extends Component
{
    public $sapiId, $peternakId, $pendampingId, $tsrId;
    public $startDate, $endDate;
    public $status;

    public function render()
    {
        return view('livewire.notif.wire-notif-search',[
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
            'status' => $this->status,
        ];
        $this->emit('formFilter',$data);
        // $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalSearch');
    }
    public function clearFilter()
    {
       $this->startDate = null;
       $this->endDate = null;
       $this->sapiId = null;
       $this->peternakId = null;
       $this->tsrId = null;
       $this->status = null;
       $this->pendampingId = null;

    }
}
