<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Kyc; 
use App\Models\User; 
use Log;
class CoinsController extends Controller
{
    public $successStatus = 200;

    public function Kyc(Request $request){
        Log::info([json_encode($request->all()),date('Y-m-d H:i:s')]);
        return response()->json(['success' =>true]); 
    }
   
}
