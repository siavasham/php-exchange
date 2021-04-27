<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Transaction; 
use App\Models\Wallet; 
use Validator;

use Log;

class HookController extends Controller
{
    public $successStatus = 200;

    public function get(Request $request){
        return response()->json(['success' =>   true]);
    }
    public function index(Request $request){
        Log::info([json_encode($request->all()),date('Y-m-d H:i:s')]);
        $validator = Validator::make($request->all(), [ 
            'coin_short_name' => 'required', 
            'address' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 200);            
        }
        if($request->type == 'receive'){
            $user_id = 0;
            $wallet = Wallet::where('address',$request->address) ->first();
            if($wallet){
                $wallet->deposit += $request->amount;   
                $wallet->balance += $request->amount;
                $wallet->save();
                $user_id = $wallet->user_id;
            }
            $credentials = ['hook_id'=>$request->id,'user_id'=>$user_id,'coin'=>$request->coin_short_name,'address'=>$request->address ,'amount'=>$request->amount,'data'=>json_encode($request->all()),'status'=>'done' ];
            $invest = Transaction::create($credentials);
            return response()->json(['success' =>   true]); 
        }
        return response()->json(['success' =>   false]);
    }
   
}
