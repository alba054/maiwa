<?php

namespace App\Http\Livewire;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelompok;
use App\Models\Pendamping;
use App\Models\PendampingPeternak;
use App\Models\Peternak;
use App\Models\User;
use Livewire\Component;

class Wirepeternakform extends Component
{
    public $desa_id, $kecamatan_id, $kabupaten_id, $nama_peternak, $no_hp, $tgl_lahir,  $jumlah_anggota, $luas_lahan, $kelompok_id, $pendamping_id, $selectedItemId;

    protected $rules = [
        'desa_id' => 'required',
        'nama_peternak' => 'required',
        'no_hp' => 'required',
        'tgl_lahir' => 'required',
        'jumlah_anggota' => 'required',
        'luas_lahan' => 'required',
        'kelompok_id' => 'required',
        'pendamping_id' => 'required',
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
            'users' => Pendamping::orderBy('user_id','ASC')->get(),
            'kelompoks' => Kelompok::orderBy('name','ASC')->get(),
            'pendampings' => Pendamping::latest()->get(),


            // 'users' => User::where('level',2)->orderBy('name','ASC')->get()
        ]);
    }
     public function save()
    {
        date_default_timezone_set("Asia/Makassar");

        $data = $this->validate();
        if($this->selectedItemId) {
            $save = Peternak::find($this->selectedItemId)->update($data);
            $peternakId = $this->selectedItemId;
        }else{
            $data['kode_peternak'] = 'PT-'.$this->quickRandom();

            $peternak = new Peternak();
            $peternak->fill($data);
            $save = $peternak->save();

            $peternakId = $peternak->id;

        }
       

        PendampingPeternak::create([
            'date' => now()->format('Y/m/d'),
            'tsr_id' => Pendamping::find($this->pendamping_id)->tsr_id,
            'pendamping_id' => $this->pendamping_id,
            'peternak_id' => $peternakId,
        ]);

        $save ? $this->emit('isSuccess',"Berhasil") : $this->emit('isError',"Terjadi kesalahan");
        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();

    }

    public static function quickRandom($length = 5)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function getModelId($modelId)
     {
        $this->selectedItemId = $modelId;
        $data = Peternak::with(['pendamping','desa','kelompok'])->find($modelId);
        $this->kode_peternak = $data->kode_peternak;
        $this->nama_peternak = $data->nama_peternak;
        $this->no_hp = $data->no_hp;
        $this->kabupaten_id = $data->desa->kecamatan->kabupaten_id;
        $this->kecamatan_id = $data->desa->kecamatan_id;
        $this->desa_id = $data->desa_id;
        $this->tgl_lahir = $data->tgl_lahir;
        $this->jumlah_anggota = $data->jumlah_anggota;
        $this->luas_lahan = $data->luas_lahan;
        $this->kelompok_id = $data->kelompok_id;
        $this->pendamping_id = $data->pendamping_id;
     }

    public function cleanVars()
     {
        $this->selectedItemId = null;
        $this->desa_id = null;
        $this->kecamatan_id = null;
        $this->kabupaten_id = null;
        $this->kode_peternak = null;
        $this->nama_peternak = null;
        $this->no_hp = null;
        $this->tgl_lahir = null;
        $this->jumlah_anggota = null;
        $this->luas_lahan = null;
        $this->kelompok_id = null;
        $this->pendamping_id = null;
     }
    
    public function forceCloseModal()
     {
         $this->cleanVars();
         $this->resetErrorBag();
         $this->resetValidation();
     }
}
