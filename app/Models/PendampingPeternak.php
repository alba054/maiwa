<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendampingPeternak extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [         
        'peternak_id' => 'integer',
        'pendamping_id' => 'integer',
        'tsr_id' => 'integer',

        ];

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
