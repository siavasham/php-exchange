<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Plan; 

class PlansController extends Controller
{
    public $successStatus = 200;

    public function Plans(Request $request){
        $plans = Plan::where('status', true)->get();
        return response()->json(['success' =>$plans]); 
    }
    public function Plan(Request $request){
        $plan = $request->plan;
        $plans = Plan::find($plan);
        return response()->json(['success' =>$plans]); 
    }
   
}
