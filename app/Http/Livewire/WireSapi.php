<?php

namespace App\Http\Livewire;

use App\Models\Pendamping;
use App\Models\Peternak;
use App\Models\Sapi;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;


class WireSapi extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $selectedItemId, $searchTerm, $peternak_id, $pendampingId;
    protected $listeners = [
        'confirmed',
        'cancelled',
        'delete',
        'isSuccess',
        'isError',
        'refreshParent'=>'$refresh',
        'isUpdate'
    ];

    public function resultData()
    {
        return Sapi::with(['jenis_sapi','peternak','status_sapi'])
        ->latest()
        ->where(function ($query){
            if($this->searchTerm != ""){
                $query->where('eartag','like','%'.$this->searchTerm.'%');
                $query->orWhere('nama_sapi','like','%'.$this->searchTerm.'%');   
                $query->orWhere('kelamin','like','%'.$this->searchTerm.'%');   
                $query->orWhere('tanggal_lahir','like','%'.$this->searchTerm.'%');   
                 
            }

            if($this->pendampingId != null){
                $query->Where('pendamping_id','like','%'.$this->pendampingId.'%');
            }
        })
        ->paginate(10);
    }
    public function render()
    {
        // dd($this->resultData());
        return view('livewire.wire-sapi',[
            'datas' => $this->resultData(),
            'peternaks' => Peternak::orderBy('nama_peternak','ASC')->get(),
            'pendampings' => Pendamping::orderBy('user_id','ASC')->get()
        ]);
    }

    public function selectedItem($item, $action)
    {
        $this->selectedItemId = $item;

        if($action == 'delete'){
            $this->triggerConfirm();
        } else if($action == 'child'){
            $this->emit('getCreateChild',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModal');
        }else{
            $this->emit('getModelId',$this->selectedItemId);
            $this->dispatchBrowserEvent('openModal');
        }
    }
    public function delete()
    {
        $path = "public/photos/";
        $path_thumb = "public/photos_thumb/";
        $data = Sapi::find($this->selectedItemId);
        
        $data->pkb()->delete();
        $data->ib()->delete();
        $data->performa()->delete();
        $data->perlakuan()->delete();
        $data->notifikasi()->delete();
        $data->straw()->delete();
        $data->laporans()->delete();
        $data->peternak_sapis()->delete();
        // $data->statussapi()->delete();

        $delete = Sapi::destroy($this->selectedItemId);
        
        if(Storage::exists($path.$data->foto_depan)){
            Storage::delete([
                $path.$data->foto_depan,
                $path.$data->foto_samping,
                $path.$data->foto_peternak,
                $path.$data->foto_rumah,

                $path_thumb.$data->foto_depan,
                $path_thumb.$data->foto_samping,
                $path_thumb.$data->foto_peternak,
                $path_thumb.$data->foto_rumah,
            ]);
            
        }

        $delete ? $this->isSuccess("Berhasil Mengahapus") : $this->isError("Terjai kesalahan, Gagal Mengahapus");
    }
    public function create()
    {
        $this->emit('cleanVars');
        $this->dispatchBrowserEvent('openModal');
    }

     public function cleanVars()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        
    }

    public function triggerConfirm()
    {
        $this->confirm('Do you wish to continue ?', [
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
