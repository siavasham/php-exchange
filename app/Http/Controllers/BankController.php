<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Bank; 
use Validator;

class BankController extends Controller
{
    public $successStatus = 200;

    public function Add(Request $request){
        $validator = Validator::make($request->all(), [ 
            'code' => 'required', 
            'number' => 'required',
            'iban' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credentials = ['user_id'=>$request->user->id,'code'=>$request->code,'number'=>$request->number,'iban'=>$request->iban];
        $credit = Bank::create($credentials);
        return response()->json(['success' => true]); 
    }
    public function List(Request $request){
        $credits = Bank::where('user_id',$request->user->id)->get();
        return response()->json(['success' =>$credits]); 
    }
    public function Update(Request $request){
         $validator = Validator::make($request->all(), [ 
            'id' => 'required', 
            'code' => 'required', 
            'number' => 'required',
            'iban' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credentials = $request->only('number','iban','code');
        Bank::where('id',$request->id)->where('user_id',$request->user->id)
            ->update($credentials);
        return response()->json(['success' =>true]);
    }
    public function Delete(Request $request){
         $validator = Validator::make($request->all(), [ 
            'id' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credits = Bank::where('id',$request->id)->where('user_id',$request->user->id)->delete();
        return response()->json(['success' =>true]);
    }
   
}
