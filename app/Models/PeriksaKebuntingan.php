<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaKebuntingan extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class)->with(['peternak','jenis_sapi']);
    }
    public function metode()  
    {
        return $this->belongsTo(Metode::class);
    }
    public function hasil()  
    {
        return $this->belongsTo(Hasil::class);
    }
}
