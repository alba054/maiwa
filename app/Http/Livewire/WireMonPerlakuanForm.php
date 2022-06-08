<?php

namespace App\Http\Livewire;

use App\Models\Hormon;
use App\Models\Laporan;
use App\Models\Obat;
use App\Models\Perlakuan;
use App\Models\PeternakSapi;
use App\Models\Sapi;
use App\Models\Upah;
use App\Models\Vaksin;
use App\Models\Vitamin;
use Intervention\Image\ImageManager;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;


class WireMonPerlakuanForm extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $selectedItemId, $sapi_id, $tgl_perlakuan, $obat_id, $dosis_obat, $vaksin_id, $dosis_vaksin, $vitamin_id, $dosis_vitamin, $hormon_id, $dosis_hormon, $ket_perlakuan;
    public $foto, $date;
    public $query, $search_results, $how_many, $sapiEartag = '';

    protected $rules = [
        'sapi_id' => 'required',
        'obat_id' => 'nullable',
        'dosis_obat' => 'nullable',
        'vaksin_id' => 'nullable',
        'dosis_vaksin' => 'nullable',
        'vitamin_id' => 'nullable',
        'dosis_vitamin' => 'nullable',
        'hormon_id' => 'nullable',
        'dosis_hormon' => 'nullable',
        'ket_perlakuan' => 'nullable',
        'foto' => 'required',
    ];

    protected $listeners = [
        'cleanVars',
        'getModelId',
        'forceCloseModal',
    ];

    public function mount()
    {
        date_default_timezone_set("Asia/Makassar");
        $today = date('Y/m/d');
        $this->date = $today;
    }
    public function updatedQuery()
    {
        // dd($this->dataSapi());
        $this->search_results = $this->dataSapi()
            ->take($this->how_many);
    }

    public function loadMore()
    {
        $this->how_many += 5;
        $this->updatedQuery();
    }

    public function resetQuery()
    {
        $this->query = '';
        $this->how_many = 5;
        $this->search_results = Collection::empty();
    }
    public function selectSapi($sapiId)
    {
        $sapi = Sapi::find($sapiId);
        $this->sapi_id = $sapi->id;
        $this->sapiEartag = 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag;
        // dd($sapiId);

    }
    public function dataSapi()
    {

        $sapi =  Sapi::orderBy('generasi')
            ->where('kondisi_lahir', '!=', 'Mati')
            ->where('eartag', 'like', '%' . $this->query . '%')
            ->orWhere('generasi', 'like', '%' . $this->query . '%')
            ->orWhere('nama_sapi', 'like', '%' . $this->query . '%')
            ->get();

        // dd(count($sapi));

        $data = Collection::empty();
        foreach ($sapi as $key => $value) {
            if ($value->kondisi_lahir != 'Mati') {
                if ($value->panens->last() != null) {
                    if ($value->panens->last()->role != 1) {
                        $data->push($value);
                    }
                } else {
                    $data->push($value);
                }
            }
        }

        return $data;
    }

    public function resultData()
    {

        $sapi =  Sapi::orderBy('generasi')
            ->where('kondisi_lahir', '!=', 'Mati')
            ->get();

        $data = [];
        foreach ($sapi as $key => $value) {
            if ($value->panens->last() != null) {
                if ($value->panens->last()->role != 1) {
                    array_push($data, $value);
                }
            } else {
                array_push($data, $value);
            }
        }

        return $data;
    }

    public function render()
    {
        return view('livewire.wire-mon-perlakuan-form', [
            'sapis' => $this->resultData(),
            'obats' => Obat::orderBy('name')->get(),
            'vaksins' => Vaksin::orderBy('name')->get(),
            'vitamins' => Vitamin::orderBy('name')->get(),
            'hormons' => Hormon::orderBy('name')->get(),
        ]);
    }

    public function save()
    {
        $validateData = [];

        $validateData = array_merge($validateData, [
            'sapi_id' => 'required',
            'obat_id' => 'nullable',
            'dosis_obat' => 'nullable',
            'vaksin_id' => 'nullable',
            'dosis_vaksin' => 'nullable',
            'vitamin_id' => 'nullable',
            'dosis_vitamin' => 'nullable',
            'hormon_id' => 'nullable',
            'dosis_hormon' => 'nullable',
            'ket_perlakuan' => 'nullable',
        ]);
        if (!$this->selectedItemId) {
            $validateData = array_merge($validateData, [
                'foto' => 'required|image|max:1024',
            ]);
        }
        $data = $this->validate($validateData);

        $data['tgl_perlakuan'] = $this->date;
        $user = PeternakSapi::orderBy('id', 'DESC')->where('sapi_id', $this->sapi_id)->first();
        if ($user) {
            $res_foto = $this->foto;
            if (!empty($res_foto)) {
                $data['foto'] = $this->handleImageIntervention($res_foto);
            }

            $data['peternak_id'] = $user->peternak_id;
            $data['pendamping_id'] = $user->pendamping_id;
            $data['tsr_id'] = $user->tsr_id;

            $save = $this->selectedItemId ? Perlakuan::find($this->selectedItemId)->update($data) : Perlakuan::create($data);
            $save ? $this->isSuccess("Data Berhasil Tersimpan") : $this->isError("Data Gagal Tersimpan");

            if (!$this->selectedItemId) {
                $upah = Upah::find(4);
                Laporan::create([
                    'sapi_id' => $this->sapi_id,
                    'peternak_id' => $data['peternak_id'],
                    'pendamping_id' => $data['pendamping_id'],
                    'tsr_id' => $data['tsr_id'],
                    'tanggal' => $this->date,
                    'perlakuan' => $upah->detail,
                    'upah' => $upah->price,
                ]);
            }

            $this->emit('refreshParent');
            $this->dispatchBrowserEvent('closeModal');
            $this->cleanVars();
        } else {
            $this->isError("Belum ada relasi sapi");
        }
    }


    public function getModelId($modelId)
    {
        $this->selectedItemId = $modelId;
        $data = Perlakuan::find($modelId);
        $this->sapi_id = $data->sapi_id;
        $this->obat_id = $data->obat_id;
        $this->dosis_obat = $data->dosis_obat;
        $this->vaksin_id = $data->vaksin_id;
        $this->dosis_vaksin = $data->dosis_vaksin;
        $this->vitamin_id = $data->vitamin_id;
        $this->dosis_vitamin = $data->dosis_vitamin;
        $this->hormon_id = $data->hormon_id;
        $this->dosis_hormon = $data->dosis_hormon;
        $this->ket_perlakuan = $data->ket_perlakuan;

        $sapi = Sapi::find($this->sapi_id);
        $this->sapiEartag = 'MBC-' . $sapi->generasi . '.' . $sapi->anak_ke . '-' . $sapi->eartag_induk . '-' . $sapi->eartag;
    }

    public function cleanVars()
    {
        $this->selectedItemId = null;
        $this->sapi_id = null;
        $this->obat_id = null;
        $this->dosis_obat = null;
        $this->vaksin_id = null;
        $this->dosis_vaksin = null;
        $this->vitamin_id = null;
        $this->dosis_vitamin = null;
        $this->hormon_id = null;
        $this->dosis_hormon = null;
        $this->ket_perlakuan = null;
        $this->sapiEartag == null;
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function handleImageIntervention($res_foto)
    {
        $res_foto->store('public/photos');
        $imageName = $res_foto->hashName();
        $data['foto'] = $imageName;

        $manager = new ImageManager();
        $image = $manager->make('storage/photos/' . $imageName)->resize(500, 300);
        $image->save('storage/photos_thumb/' . $imageName);

        return $imageName;
    }
    public function isSuccess($msg)
    {
        $this->alert('success', $msg, [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
    public function isError($msg)
    {
        $this->alert('error', $msg, [
            'position' =>  'top-end',
            'timer' =>  3000,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  false,
        ]);
    }
}
