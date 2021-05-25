<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Constans; 
use app\Library\ExchangeRate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $exchangeRate = new ExchangeRate();
        $coins = $exchangeRate->getCoins();
        $sliders = [];
        foreach($coins as $coin){
            if($coin->slider)
            $sliders[]=$coin;
        }
        // $sliders  = array_filter($coins, function($v, $k) {return  $v['slider']==1 ;}, ARRAY_FILTER_USE_BOTH);
        $temp = Constans::where('category','home')->get();
        $constans = [];
        foreach($temp as $t){
           $constans[$t->key] =  $t->value;
        }
        app()->setlocale('fa');
        return view('home',['sliders'=>$sliders,'constans'=>(object)$constans]);
    }


    
}

