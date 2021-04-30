<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coin; 

class CoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coin::truncate();

        Coin::insert([
            ['name'=>'BTC','fullname'=>'Bitcoin','dname'=>'بیت کوین','balance'=>1,'slider'=>true,'list'=>true],
            ['name'=>'ETH','fullname'=>'Ethereum','dname'=>'اتریوم','balance'=>2,'slider'=>true,'list'=>true],
            ['name'=>'BCH','fullname'=>'Bitcoin Cash','dname'=>'بیت کوین کش','balance'=>5,'slider'=>true,'list'=>true],
            ['name'=>'DOGE','fullname'=>'DogeCoin','dname'=>'دوج کوین','balance'=>10000,'slider'=>true,'list'=>true],
            ['name'=>'DASH','fullname'=>'Dash','dname'=>'دش','balance'=>10,'slider'=>true,'list'=>true],
            ['name'=>'LTC','fullname'=>'Litecoin','dname'=>'لایت کوین','balance'=>15,'slider'=>true,'list'=>true],
        ]);
    }
}
