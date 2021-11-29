<?php

namespace App\Http\Livewire\Perlakuan;

use App\Models\Hormon;
use App\Models\Obat;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use App\Models\Tsr;
use App\Models\Vaksin;
use App\Models\Vitamin;
use Livewire\Component;

class WireFormPerlakuanSearch extends Component
{
    public $sapiId, $peternakId, $pendampingId, $tsrId, $obatId, $vitaminId, $vaksinId, $hormonId;
    public $startDate, $endDate;
    public function render()
    {
        return view('livewire.perlakuan.wire-form-perlakuan-search',[
            'sapis' => Sapi::orderBy('generasi','ASC')->get(),
            'pendampings' => Pendamping::orderBy('id','ASC')->get(),
            'tsrs' => Tsr::orderBy('id','ASC')->get(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get(),
            'obats' => Obat::orderBy('name')->get(),
            'vaksins' => Vaksin::orderBy('name')->get(),
            'vitamins' => Vitamin::orderBy('name')->get(),
            'hormons' => Hormon::orderBy('name')->get(),
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
            'obatId' => $this->obatId,
            'vitaminId' => $this->vitaminId,
            'vaksinId' => $this->vaksinId,
            'hormonId' => $this->hormonId,
        ];
        $this->emit('formFilter',$data);
        // $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalSearch');
    }
}
