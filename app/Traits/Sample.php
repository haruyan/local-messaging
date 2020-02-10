<?php

namespace App\Traits;

use App\Models\TipeSurat;
use App\Models\Penerima;

trait Sample
{
    public function printThis()
    {
        $user = Auth()->User()->instansi_id;
        $menu = TipeSurat::where("instansi_id","=",$user)->get();
        $notif = Penerima::with('surat.pengirim')->where('penerima_id',$user)->get();
        $data = array(
            'count' => $notif->where('status','terkirim')->count(),
            'data' => $notif,
        );
        return compact('menu','data');
    }
}