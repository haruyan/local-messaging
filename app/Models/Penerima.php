<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    protected $table = 'penerima';
    protected $guarded = ['id'];
    
    public function surat(){
        return $this->belongsTo(Surat::class);
    }

    public function surat2(){
        return $this->hasMany(Surat::class, 'id', 'surat_id');
    }

    public function instansi(){
        return $this->belongsTo(Instansi::class, 'penerima_id', 'id');
    }
}
