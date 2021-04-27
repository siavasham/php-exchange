<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Coin; 

class CoinsController extends Controller
{
    public $successStatus = 200;

    public function coins(Request $request){
        $coins = Coin::where('status', true)->get();
        return response()->json(['success' =>$coins]); 
    }
   
}
