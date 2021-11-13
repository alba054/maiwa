<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performa extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [ 
        'sapi_id' => 'integer', 
        'peternak_id' => 'integer',
        'pendamping_id' => 'integer',
        'tsr_id' => 'integer',
        'tinggi_badan' => 'integer',
        'berat_badan' => 'integer',
        'panjang_badan' => 'integer',
        'lingkar_dada' => 'integer',
        'bsc' => 'integer',
        ];
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class)->with(['jenis_sapi']);
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
