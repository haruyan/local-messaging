<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Surat;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany('App\Models\User');
    }
}
