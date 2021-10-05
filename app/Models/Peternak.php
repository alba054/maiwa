<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peternak extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()  
    {
        return $this->belongsTo(User::class);
    }
    public function desa()  
    {
        return $this->belongsTo(Desa::class)->with('kecamatan');
    }
}
