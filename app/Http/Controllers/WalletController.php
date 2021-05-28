<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Wallet; 
use App\Models\Address; 
use App\Models\Coin; 
use App\Models\Transaction; 
use App\Models\Currency; 
use Validator;
use app\Library\ExchangeRate;

class WalletController extends Controller
{
    public $successStatus = 200;

    public function PreDeposit(Request $request){
         $validator = Validator::make($request->all(), [ 
            'coin' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $wallet = Wallet::where('user_id',$request->user->id)->where('coin',$request->coin) ->first();
        if(!$wallet){
            $credentials = ['user_id'=>$request->user->id,'coin'=>$request->coin];
            $wallet = Wallet::updateOrCreate($credentials);   
        }
        if($request->coin == "IR"){
            return response()->json(['success' =>$wallet]); 
        }
        $address = Address::where('wallet_id',$wallet->id)->where('status',true)->get();
        return response()->json(['success' =>$address]); 
    }
    public function Deposit(Request $request){
         $validator = Validator::make($request->all(), [ 
            'coin' => 'required', 
            'amount' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credentials = ['user_id'=>$request->user->id,'coin'=>$request->coin,'address'=>$request->address??'' ,'amount'=>$request->amount,'data'=>''];
        $transaction = Transaction::create($credentials);
        return response()->json(['success' =>$transaction]); 
    }
    public function Wallet(Request $request){
        $wallet = Wallet::where('user_id',$request->user->id)->get();
        $currency = Currency::where('default',true)->first();

        $exchangeRate = new ExchangeRate();
        $coins = $exchangeRate->getCoins();

        return response()->json(['success' =>['coins'=>$coins,'wallet'=>$wallet,'currency'=>$currency]]); 
    }
    public function Withdraw(Request $request){
        $validator = Validator::make($request->all(), [ 
            'coin' => 'required', 
            'amount' => 'required', 
            'address' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $wallet = Wallet::where('user_id',$request->user->id)->where('coin',$request->coin) ->first();
        if(!$wallet){
            return response()->json(['error' => 'no-wallet-found']); 
        }
        // $withdrawable =  $wallet->balance + $wallet->profit + $wallet->referral -$wallet->freezed ;
        if($wallet->balance < $request->amount){
            return response()->json(['error' =>['amount'=>['validation.moreBalance']]] );
        }
        $credential1 = $request->only('coin','amount','address','tag');
        $credential2 = ['user_id'=>$request->user->id,'type'=> 'withdraw','data'=>''];
        $transaction = Transaction::create($credential1+$credential2);
        return response()->json(['success' =>$transaction]); 
    }
    
}
