<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peternak extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [ 
        'kelompok_id' => 'integer',
        'pendamping_id' => 'integer',
        'desa_id' => 'integer',
        ];

    public function kelompok()  
    {
        return $this->belongsTo(Kelompok::class);
    }
    public function pendamping()  
    {
        return $this->belongsTo(Pendamping::class)->with('user');
    }
    public function desa()  
    {
        return $this->belongsTo(Desa::class)->with('kecamatan');
    }
}
