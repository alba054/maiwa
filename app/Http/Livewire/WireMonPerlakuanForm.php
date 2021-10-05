<?php

namespace App\Http\Livewire;

use App\Models\Perlakuan;
use App\Models\Sapi;
use Livewire\Component;

class WireMonPerlakuanForm extends Component
{
    public $selectedItemId, $sapi_id, $tgl_perlakuan, $jenis_obat, $dosis_obat, $vaksin, $dosis_vaksin, $vitamin, $dosis_vitamin, $hormon, $dosis_hormon, $ket_perlakuan;
    protected $rules = [
        'sapi_id' => 'required',
        'tgl_perlakuan' => 'required',
        'jenis_obat' => 'required',
        'dosis_obat' => 'required',
        'vaksin' => 'required',
        'dosis_vaksin' => 'required',
        'vitamin' => 'required',
        'dosis_vitamin' => 'required',
        'hormon' => 'required',
        'dosis_hormon' => 'required',
        'ket_perlakuan' => 'required',
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];

    public function render()
    {
        return view('livewire.wire-mon-perlakuan-form',[
            'sapis' => Sapi::orderBy('nama_sapi')->get()
        ]);
    }

    public function save()
    {
        $save = $this->selectedItemId ? $this->update() : $this->store();
    }
    public function store()
    {
        $data = $this->validate();

        $save = Perlakuan::create($data); 
        $save ? $this->emit('isSuccess',"Berhasil") : $this->emit('isError',"Terjadi kesalahan");
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();
        
    }
    public function update()
    {
        $validateData = [];
        
        $validateData = array_merge($validateData,[
           'sapi_id' => 'required',
           'jenis_obat' => 'required',
            'dosis_obat' => 'required',
            'vaksin' => 'required',
            'dosis_vaksin' => 'required',
            'vitamin' => 'required',
            'dosis_vitamin' => 'required',
            'hormon' => 'required',
            'dosis_hormon' => 'required',
            'ket_perlakuan' => 'required',
        ]);
        $data = $this->validate($validateData);

        if ($this->tgl_perlakuan) {
            $data['tgl_perlakuan'] = $this->tgl_perlakuan;
        }
        
        $save = Perlakuan::find($this->selectedItemId)->update($data);

        $save ? $this->emit('isSuccess',"Berhasil") : $this->emit('isError',"Terjadi kesalahan");
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();
        
    }

    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $data = Perlakuan::find($modelId);
        $this->sapi_id = $data->sapi_id;
        $this->jenis_obat = $data->jenis_obat;
        $this->dosis_obat = $data->dosis_obat;
        $this->vaksin = $data->vaksin;
        $this->dosis_vaksin = $data->dosis_vaksin;
        $this->vitamin = $data->vitamin;
        $this->dosis_vitamin = $data->dosis_vitamin;
        $this->hormon = $data->hormon;
        $this->dosis_hormon = $data->dosis_hormon;
        $this->ket_perlakuan = $data->ket_perlakuan;
     }

    public function cleanVars()
     {
        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->jenis_obat = null;
        $this->dosis_obat = null;
        $this->vaksin = null;
        $this->dosis_vaksin = null;
        $this->vitamin = null;
        $this->dosis_vitamin = null;
        $this->hormon = null;
        $this->dosis_hormon = null;
        $this->ket_perlakuan = null;
     }
    
    public function forceCloseModal()
     {
         $this->cleanVars();
         $this->resetErrorBag();
         $this->resetValidation();
     }
}
