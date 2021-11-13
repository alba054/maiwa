<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [ 
        'sapi_id' => 'integer', 
        'peternak_id' => 'integer',
        ];

    public function peternak()  
    {
        return $this->belongsTo(Peternak::class);
    }
    public function sapi()  
    {
        return $this->belongsTo(Sapi::class);
    }
}
