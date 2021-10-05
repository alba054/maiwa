<?php

namespace App\Http\Livewire;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Peternak;
use App\Models\User;
use Livewire\Component;

class Wirepeternakform extends Component
{
    public $desa_id, $user_id, $kecamatan_id, $kabupaten_id, $kode_peternak, $nama_peternak, $no_hp, $tgl_lahir,  $jumlah_anggota, $luas_lahan, $kelompok, $selectedItemId;

    protected $rules = [
        'desa_id' => 'required',
        'user_id' => 'required',
        'kode_peternak' => 'required',
        'nama_peternak' => 'required',
        'no_hp' => 'required',
        'tgl_lahir' => 'required',
        'jumlah_anggota' => 'required',
        'luas_lahan' => 'required',
        'kelompok' => 'required',
    ];
    protected $messages = [
        'email.required' => 'this field is required.',
        'name.required' => 'this field is required.',  
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];
    public function render()
    {
        return view('livewire.wirepeternakform',[
            'kabupatens' => Kabupaten::orderBy('name','ASC')->get(),
            'kecamatans' => Kecamatan::orderBy('name','ASC')->where('kabupaten_id',$this->kabupaten_id)->get(),
            'desas' => Desa::orderBy('name','ASC')->where('kecamatan_id',$this->kecamatan_id)->get(),
            'users' => User::where('hak_akses',2)->get()
            // 'users' => User::where('level',2)->orderBy('name','ASC')->get()
        ]);
    }
     public function save()
    {
        $data = $this->validate();
        $save = $this->selectedItemId ? Peternak::find($this->selectedItemId)->update($data) : Peternak::create($data); 
        $save ? $this->emit('isSuccess',"Berhasil") : $this->emit('isError',"Terjadi kesalahan");
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();

    }
    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $data = Peternak::with(['pembimbing','desa'])->find($modelId);
        $this->kode_peternak = $data->kode_peternak;
        $this->nama_peternak = $data->nama_peternak;
        $this->no_hp = $data->no_hp;
        $this->kabupaten_id = $data->desa->kecamatan->kabupaten_id;
        $this->kecamatan_id = $data->desa->kecamatan_id;
        $this->desa_id = $data->desa_id;
        $this->user_id = $data->user_id;
        $this->tgl_lahir = $data->tgl_lahir;
        $this->jumlah_anggota = $data->jumlah_anggota;
        $this->luas_lahan = $data->luas_lahan;
        $this->kelompok = $data->kelompok;
     }

    public function cleanVars()
     {
        $this->selectedItemId = null;
        $this->desa_id = null;
        $this->user_id = null;
        $this->kecamatan_id = null;
        $this->kabupaten_id = null;
        $this->kode_peternak = null;
        $this->nama_peternak = null;
        $this->no_hp = null;
        $this->tgl_lahir = null;
        $this->jumlah_anggota = null;
        $this->luas_lahan = null;
        $this->kelompok = null;
     }
    
    public function forceCloseModal()
     {
         $this->cleanVars();
         $this->resetErrorBag();
         $this->resetValidation();
     }
}
