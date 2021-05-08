<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User; 
use App\Models\Login; 
use App\Models\Token; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    public function Login(Request $request){
         $validator = Validator::make($request->all(), [ 
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $user = User::where('phone',$request->phone)->first();
        if(!$user){
            $user = User::updateOrCreate(['phone'=>$request->phone,'status'=>true]);   
        }
        if($user->status != true){
            return response()->json(['error' => 'inactive-user']); 
        }
        $token = Token::create([
            'user_id' => $user->id
        ]);
        
        if ($token->sendCode()) {
            return response()->json(['success' =>true]);
        }
        else{
            return response()->json(['success' =>$token->code]);
        }
    }
    public function Verify(Request $request){
         $validator = Validator::make($request->all(), [ 
            'code' => 'required|regex:/[0-9]{5}/', 
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $user = User::where('phone',$request->phone)->first();
        if(!$user){
            return response()->json(['error'=>'invalid-number']);
        }
        $token = Token::where('user_id',$user->id) ->orderByDesc('id') ->first();
        if($token){
            if($token->manyTrid()){
                return response()->json(['error' => 'to-many-try']); 
            }
            if(!$token->isValid()){
                return response()->json(['error' => 'code-is-used-or-expired']); 
            }
            if($token->code != $request->code){
                $token->increment('try');
                $token->save();
                 return response()->json(['error' => 'invalid-code']); 
            }
            $token->delete();
            
            
            return  $this->makeLogin($user,$request);
             
        }
        return response()->json(['error' => 'validation.code']); 
    }
    public function Me(Request $request){
        return response()->json(['success' => $request->user]); 
    }
    public function Profile(Request $request){
        $user = User::where('id',$request->user->id) ->first();
        if(!$user){
            return response()->json(['error' => 'wrong-user']); 
        }
        return response()->json(['success' =>$user]);
    }
    public function Update(Request $request){
        $credentials = $request->only('name','email','address');
        User::where('id',$request->user->id)
            ->update($credentials);
        return response()->json(['success' =>true]);
    }

    function makeLogin($user,$request){
        $credentials = ['user_id'=>$user->id,'ip'=> $request->ip()];
        Login::create($credentials);
        $user_data = ['id'=>$user->id];
        $token = $this->generateToken($user_data);
        return response()->json(['success' =>['token'=>$token,'name'=>$user->name,'phone'=>$user->phone]]);
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
