<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::insert([
            ['name'=>'admin','email'=>'admin@strong.hold','password'=>'21232f297a57a5a743894a0e4a801fc3','lang'=>'fa']
        ]);
    }
}
