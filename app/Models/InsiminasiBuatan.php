<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsiminasiBuatan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [ 
        'sapi_id' => 'integer', 
        'peternak_id' => 'integer',
        'pendamping_id' => 'integer',
        'tsr_id' => 'integer',
        'strow_id' => 'integer',
        'user_id' => 'integer',
        'dosis_ib' => 'integer',
        
        ];
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class)->with(['status_sapi','jenis_sapi']);
    }
    public function strow()  
    {
        return $this->belongsTo(Strow::class);
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
