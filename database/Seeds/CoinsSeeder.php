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
            ['name'=>'BTC','fullname'=>'Bitcoin'],
            ['name'=>'ETH','fullname'=>'Ethereum'],
            ['name'=>'BCH','fullname'=>'Bitcoin Cash'],
            ['name'=>'DOGE','fullname'=>'DogeCoin'],
            ['name'=>'DASH','fullname'=>'Dash'],
            ['name'=>'LTC','fullname'=>'Litecoin'],
            ['name'=>'USDT','fullname'=>'USDT'],
        ]);
    }
}
