<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeSurat extends Model
{
    protected $table = 'type_surat';
    protected $guarded = ['id'];
    
    public function instansi(){
        return $this->belongsTo('App\Models\Instansi');
    }
}
