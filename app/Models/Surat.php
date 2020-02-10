<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $guarded = ['id'];
    
    public function penerima(){
        return $this->hasMany(Penerima::class, 'surat_id', 'id');
    }
    
    public function tipesurat(){
        return $this->belongsTo('App\Models\TipeSurat', 'type_surat_id', 'id');
    }
    
    public function pengirim(){
        return $this->belongsTo('App\Models\Instansi', 'pengirim_id', 'id');
    }
}
