<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
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
        		"id"=>1,
                "instansi_id"=>1,
                "nama"=>"admin system",
                "username"=>"admin",
                "password"=>bcrypt("password"),
                "email"=>"admin@admin.com",
                "no_hp"=>"089767587685",
                "role"=>"admin",
                "created_at"    =>  Carbon::now(),
                "updated_at"    =>  Carbon::now()
        	],[
        		"id"=>2,
                "instansi_id"=>2,
                "nama"=>"polisi admin",
                "username"=>"polisi",
                "password"=>bcrypt("password"),
                "email"=>"polisi@admin.com",
                "no_hp"=>"098765432345",
                "role"=>"user",
                "created_at"    =>  Carbon::now(),
                "updated_at"    =>  Carbon::now()
            ]
        ];

    	User::insert($data);
    }
}
