<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan; 

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::truncate();

        Plan::insert([
            ['type'=>'daily','profit'=>.3,'invest' => .001],
            ['type'=>'weekly','profit'=>2.5,'invest' => .005],
            ['type'=>'monthly','profit'=>12,'invest' => .01],
            ['type'=>'semiAnnualy','profit'=>90,'invest' => .02],
            ['type'=>'annualy','profit'=>200,'invest' => .05],
        ]);
    }
}
