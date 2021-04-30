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
        $sliders = $exchangeRate->getSliderCoin();
        $temp = Constans::where('category','home')->get();
        $constans = [];
        foreach($temp as $t){
           $constans[$t->key] =  $t->value;
        }
        app()->setlocale('fa');
        return view('home',['sliders'=>$sliders,'constans'=>(object)$constans]);
    }


    
}

