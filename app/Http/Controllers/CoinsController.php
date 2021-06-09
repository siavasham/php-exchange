<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Coin; 
use app\Library\ExchangeRate;
use App\Models\Currency; 

class CoinsController extends Controller
{
    public $successStatus = 200;

    public function Coins(Request $request){
        $exchangeRate = new ExchangeRate();
        $coins = $exchangeRate->getCoins();
        $currency = Currency::where('default',true)->first();
        return response()->json(['success' =>['coins' =>$coins,'currency'=>$currency]]); 
    }
    public function Refresh(Request $request){
        $exchangeRate = new ExchangeRate();
        $coins = $exchangeRate->getCoins();
        return response()->json(['success' =>true]); 
    }
   
}
