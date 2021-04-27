<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Invest; 
use App\Models\Wallet; 
use Validator;
// use DB;
// use Log;
// DB::listen(function($query) {
//     Log::info(
//         $query->sql,
//         $query->bindings,
//         $query->time
//     );
// });
class InvestController extends Controller
{
    public $successStatus = 200;

    public function start(Request $request){
        $validator = Validator::make($request->all(), [ 
            'plan' => 'required', 
            'coin' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $wallet = Wallet::where('user_id',$request->user->id)->where('coin',$request->coin) ->first();
        if($request->amount > $wallet->balance)
            return response()->json(['error' => true]); 
        $credentials = ['user_id'=>$request->user->id,'plan_id'=>$request->plan,'coin'=>$request->coin ,'amount'=>$request->amount ];
        $invest = Invest::create($credentials);
        $wallet->balance -= $request->amount;
        $wallet->freezed += $request->amount;
        $wallet->save();
        return response()->json(['success' =>   true]); 
    }
   
   
    public function history(Request $request){
         $invest = Invest::where('user_id',$request->user->id)
                ->get()
                ->map(function ($ref) {
                    $ref->plan = $ref->plan;
                    return $ref;
                });
        return response()->json(['success' => $invest]); 
    }
   
}
