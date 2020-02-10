<?php

use App\Models\Instansi;
use Illuminate\Database\Seeder;

class InstansiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
        		"nama"=>"admin"
        	],[
                "nama"=>"polisi"
            ],[
                "nama"=>"pengadilan"
            ],[
                "nama"=>"kejaksaan"
            ],[
                "nama"=>"lapas"
            ]
        ];
    	Instansi::insert($data);
    }
}
