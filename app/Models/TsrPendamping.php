<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TsrPendamping extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [ 
        'pendamping_id' => 'integer',
        'tsr_id' => 'integer',
        ];
    public function tsr()  
    {
        return $this->belongsTo(Tsr::class);
    }
    public function pendamping()  
    {
        return $this->belongsTo(Pendamping::class);
    }
}
