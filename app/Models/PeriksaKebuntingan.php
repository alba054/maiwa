<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriksaKebuntingan extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [ 
        'sapi_id' => 'integer', 
        'peternak_id' => 'integer',
        'pendamping_id' => 'integer',
        'tsr_id' => 'integer',
        'metode_id' => 'integer',
        'hasil_id' => 'integer',
        'status' => 'integer',
        'reproduksi' => 'integer',

        ];

    public function sapi()  
    {
        return $this->belongsTo(Sapi::class)->with(['jenis_sapi','peternak']);
    }
    public function metode()  
    {
        return $this->belongsTo(Metode::class);
    }
    public function hasil()  
    {
        return $this->belongsTo(Hasil::class);
    }
    public function peternak()  
    {
        return $this->belongsTo(Peternak::class);
    }
    public function pendamping()  
    {
        return $this->belongsTo(Pendamping::class);
    }
    public function tsr()  
    {
        return $this->belongsTo(Tsr::class);
    }
}
