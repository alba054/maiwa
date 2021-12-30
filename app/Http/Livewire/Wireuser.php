<?php

namespace App\Http\Livewire;

use App\Models\Desa;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Pendamping;
use App\Models\Tsr;
use App\Models\TsrPendamping;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Wireuser extends Component
{
    use LivewireAlert;

    public $hak_akses, $name, $email, $password, $selectedItemId, $searchTerm, $tsr_id, $alamat, $no_hp;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];
    protected $messages = [
        'email.required' => 'this field is required.',
        'name.required' => 'this field is required.',  
    ];
    protected $listeners =[
        'delete',
        'cancelled'
    ];

    public function mount($id)
    {
        date_default_timezone_set("Asia/Makassar");
        $this->hak_akses = $id;
    }
    public function resultData()
    {
        return User::orderBy('name','ASC')
        ->where('hak_akses', $this->hak_akses)
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('name','like','%'.$this->searchTerm.'%');
                $query->orwhere('no_hp','like','%'.$this->searchTerm.'%');
                $query->orwhere('alamat','like','%'.$this->searchTerm.'%');
            }  
        })
        ->get();
    }

    public function render()
    {
        return view('livewire.wireuser',[
            'users' => $this->resultData(),
            'tsrs' => Tsr::orderBy('id')->get(),
            'pendampings' => Pendamping::orderBy('id')->get()
        ]);
    }

    public function selectemItem($itemId, $action)
    {

        $this->selectedItemId = $itemId;
        $action == 'delete' ? $this->triggerConfirm() : $this->edit(); 
        
    }
    public function edit()
    {
        $data = User::find($this->selectedItemId);
        $this->hak_akses = $data->hak_akses;
        $this->photo_update = $data->photo;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->alamat = $data->alamat;
        $this->no_hp = $data->no_hp;

        if ($this->hak_akses == '3') {
            $this->tsr_id = Pendamping::where('user_id', $this->selectedItemId)->first()->tsr_id;
        }
        
    }
    
    public function save()
    {
        $this->selectedItemId ? $this->update()  : $this->store();       
    }
    public function store()
    {
        $validateData = [];
        
        $validateData = array_merge($validateData,[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($this->hak_akses == 3) {
            $validateData = array_merge($validateData,[
                'tsr_id' => 'required',
            ]);

            $data['tsr_id'] = $this->tsr_id;
        }
        
        $data = $this->validate($validateData);
        
        $data['password'] = Hash::make($this->password);
        $data['hak_akses'] = $this->hak_akses;
        $data['alamat'] = $this->alamat ? $this->alamat : 'alamat';
        $data['no_hp'] = $this->no_hp ? $this->no_hp :'no_hp';
        $save = User::create($data);
        if ($save) {
            $this->isSuccess("Data Berhasil Tersimpan");
            if ($this->hak_akses == 2) {
                Tsr::create([
                        'user_id' => $save->id
                ]);
            } else if(($this->hak_akses == 3)) {
                $pendamping = Pendamping::create([
                    'user_id' => $save->id,
                    'tsr_id' => $data['tsr_id']
                ]);

                TsrPendamping::create([
                    'pendamping_id' => $pendamping->id,
                    'tsr_id' => $pendamping->tsr_id,
                    'date' => now()->format('Y/m/d'),
                ]);
            }
            
        } else {
            $this->isError("Data Gagal Tersimpan");
        }
        
       

        $this->cleanVars();

    }
    public function update()
    {
        
        $validateData = [];
        
        $validateData = array_merge($validateData,[
            'name' => 'required',
        ]);

        if ($this->hak_akses == 3) {
            $validateData = array_merge($validateData,[
                'tsr_id' => 'required',
            ]);

            $data['tsr_id'] = $this->tsr_id;
            
            $pendamping = Pendamping::where('user_id', $this->selectedItemId)->first();

            $pendamping->update([
                'tsr_id' => $data['tsr_id']
            ]);

           
                TsrPendamping::create([
                    'pendamping_id' => $pendamping->id,
                    'tsr_id' => $data['tsr_id'],
                    'date' => now()->format('Y/m/d'),
                ]);
            

            
        }

        $data = $this->validate($validateData);
       
        if($this->password){
            $data['password'] = Hash::make($this->password);
        }
        if($this->alamat){
            $data['alamat'] = $this->alamat;
        }
        if($this->no_hp){
            $data['no_hp'] = $this->no_hp;
        }
        
        $save = User::find($this->selectedItemId)->update($data);
        $save ? $this->isSuccess("Data Berhasil diUbah") : $this->isError("Data Gagal diUbah");

        $this->cleanVars();

    }
    public function delete()
    {
        if ($this->hak_akses == 3) {

            $pendamping = Pendamping::where('user_id', $this->selectedItemId)->first();
            TsrPendamping::where('pendamping_id', $pendamping->id)->delete();
            $pendamping->delete();

        } else if ($this->hak_akses == 2) {

            $tsr = Tsr::where('user_id', $this->selectedItemId)->first();
            // dd($tsr->pendampings()->get());
            foreach ($tsr->pendampings()->get() as $key => $value) {

                TsrPendamping::where('pendamping_id', $value->id)->delete();
                $pendamping = Pendamping::find($value->id);
                $pendamping->delete();
                User::destroy($pendamping->user_id);


            }
            $tsr->delete();
        }
        
        $delete = User::destroy($this->selectedItemId);
        $delete ? $this->isSuccess("Data Berhasil Terhapus") : $this->isError("Data Gagal Dihapus");
        
        $this->cleanVars();

    }
    public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->selectedItemId = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->alamat = null;
        $this->no_hp = null;
        $this->tsr_id = null;
    }

    public function triggerConfirm()
    {
        $this->confirm('yakin akan menghapus data ?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'showCancelButton' =>  true, 
            'onConfirmed' => 'delete',
            'onCancelled' => 'cancelled'
        ]);
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
    public function confirmed()
    {
        // Example code inside confirmed callback
    
        $this->alert('success', 'Hello World!', [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true, 
            'text' =>  '', 
            'confirmButtonText' =>  'Ok', 
            'cancelButtonText' =>  'Cancel', 
            'showCancelButton' =>  true, 
            'showConfirmButton' =>  true, 
      ]);
    }
    
    public function cancelled()
    {
        // Example code inside cancelled callback
    
        $this->alert('info', 'Understood');
    }
}
