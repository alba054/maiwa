<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class)->with(['peternak','jenis_sapi']);
    }

    public static function allnotif($id)
    {
        return Notifikasi::with('sapi')
            ->orderBy('tanggal','ASC')
            ->whereHas('sapi.peternak', function($q) use($id) {
            
            if($id != null){
                $q->where('user_id', $id);
            }
            
            })
            ->get();
    }
}
