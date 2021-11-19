<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndukAnak extends Model
{
    use HasFactory;

    protected $casts = [ 
        'induk_id' => 'integer', 
        'anak_id' => 'integer', 
        ];
    public function induk()  
    {
        return $this->belongsTo(Sapi::class)->with('induk');
    }
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class, 'anak_id');
    }
    // public function anak()  
    // {
    //     return $this->belongsToMany(Sapi::class);
    // }
}
