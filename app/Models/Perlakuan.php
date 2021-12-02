<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perlakuan extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [ 
        'sapi_id' => 'integer', 
        'peternak_id' => 'integer',
        'pendamping_id' => 'integer',
        'tsr_id' => 'integer',
        'vitamin_id' => 'integer',
        'dosis_vitamin' => 'integer',
        'vaksin_id' => 'integer',
        'dosis_vaksin' => 'integer',
        'hormon_id' => 'integer',
        'dosis_hormon' => 'integer',
        'obat_id' => 'integer',
        'dosis_obat' => 'integer',
        ];
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class)->with(['peternak','jenis_sapi']);
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
    public function vitamin()  
    {
        return $this->belongsTo(Vitamin::class);
    }
    public function vaksin()  
    {
        return $this->belongsTo(Vaksin::class);
    }
    public function hormon()  
    {
        return $this->belongsTo(Hormon::class);
    }
    public function obat()  
    {
        return $this->belongsTo(Obat::class);
    }
}
