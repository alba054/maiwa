<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapi extends Model
{

    use HasFactory;
    protected $guarded = [];

    protected $casts = [ 
        'jenis_sapi_id' => 'integer', 
        'status_sapi_id' => 'integer',
        'peternak_id' => 'integer',
       
        ];

    public function peternak()  
    {
        return $this->belongsTo(Peternak::class)->with(['desa','pendamping']);
    }
    
    public function jenis_sapi()  
    {
        return $this->belongsTo(JenisSapi::class);
    }
    public function pkb()
    {
        return $this->hasMany(PeriksaKebuntingan::class);
    }
    public function performa()
    {
        return $this->hasMany(Performa::class);
    }
    public function ib()
    {
        return $this->hasMany(InsiminasiBuatan::class);
    }
    public function perlakuan()
    {
        return $this->hasMany(Perlakuan::class);
    }
    public function panens()
    {
        return $this->hasMany(Panen::class);
    }
    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }
    public function straw()
    {
        return $this->hasMany(Strow::class);
    }
    public function status_sapi()
    {
        return $this->belongsTo(StatusSapi::class);
    }
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
    public function peternak_sapis()
    {
        return $this->hasMany(PeternakSapi::class);
    }

    public function anaks()
    {
        return $this->hasMany(IndukAnak::class, 'induk_id')->with('sapi');
    }
    public function induk()
    {
        return $this->hasOne(IndukAnak::class, 'anak_id')->with('induk');
    }
    
}
