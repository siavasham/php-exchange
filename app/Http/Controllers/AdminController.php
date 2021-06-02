<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Admin; 
use Validator;

class AdminController extends Controller
{
    public $successStatus = 200;
    public function Login(Request $request){
         $validator = Validator::make($request->all(), [ 
            'username' => 'required', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $user = Admin::where('username',$request->username)->where('password',md5($request->password)) ->first();
        if(!$user){
             return response()->json(['error' => 'wrong-user-pass']); 
        }
        return  $this->makeLogin($user,$request);
    }
    public function Me(Request $request){
        return response()->json(['success' => $request->user]); 
    }
    function makeLogin($user,$request){
        $user_data = ['id'=>$user->id,'admin'=>true];
        $token = $this->generateToken($user_data);
        return response()->json(['success' =>['token'=>$token]]);
    }
    function generateToken($user_data){
        $factory = JWTFactory::customClaims([
            'sub'   => 'user',
            'ttl'   => env('JWT_TTL', null),
            'user'  => $user_data
        ]);
        $payload = $factory->make();
        return JWTAuth::encode($payload)->get();
    }

}
