<?php

namespace App\Http\Livewire;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Tsr;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Wirepeternaksearch extends Component
{
    use LivewireAlert;

    public $pendampingId, $tsrId, $desaId, $kecamatanId, $kabupatenId;
    public function render()
    {
        return view('livewire.wirepeternaksearch',[
            'tsrs' => Tsr::orderBy('id','ASC')->get(),
            'pendampings' => Pendamping::orderBy('id','ASC')->get(),
            'kabupatens' => Kabupaten::orderBy('name','ASC')->get(),
            'desas' => Desa::orderBy('name','ASC')->where('kecamatan_id', $this->kecamatanId)->get(),
            'kecamatans' => Kecamatan::orderBy('name','ASC')->where('kabupaten_id', $this->kecamatanId)->get(),

        ]);
    }
    public function submit()
    {
        $data = [
            'pendampingId' => $this->pendampingId,
            'tsrId' => $this->tsrId,
            'desaId' => $this->desaId,
            'kecamatanId' => $this->kecamatanId,
            'kabupatenId' => $this->kabupatenId,
        ];
        $this->emit('formFilter',$data);
        // $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModalSearch');
    }
    public function clearFilter()
    {
        $this->pendampingId = null;
        $this->tsrId = null;
        $this->desaId = null;
        $this->kecamatanId = null;
        $this->kabupatenId = null;
        
        $data = [
            'pendampingId' => $this->pendampingId,
            'tsrId' => $this->tsrId,
            'desaId' => $this->desaId,
            'kecamatanId' => $this->kecamatanId,
            'kabupatenId' => $this->kabupatenId,
        ];
        // $this->emit('formFilter',$data);
        // $this->dispatchBrowserEvent('closeModalSearch');
    }
}
