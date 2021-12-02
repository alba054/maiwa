<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strow extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [ 
        'sapi_id' => 'integer', 
        
        ];
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class)->with(['peternak','jenis_sapi']);
    }
}
