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

    public function dataSapi()
    {
       
        $sapi =  Sapi::orderBy('generasi')
        ->where('kondisi_lahir' ,'!=', 'Mati')
        ->get();

        $data = [];
        foreach ($sapi as $key => $value) {
            if ($value->panens->last() != null) {
                if ($value->panens->last()->role != 1) {
                    array_push($data, $value);   
                }
            }else {
                array_push($data, $value);
                
            }
            
        }

        return $data;
    }

    public function render()
    {
        return view('livewire.panen.wire-mon-panen-search',[
            'sapis' => $this->dataSapi(),
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
