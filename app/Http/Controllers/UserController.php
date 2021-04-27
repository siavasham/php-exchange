<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller; 
use App\Models\User; 
use App\Models\TempUser; 
use App\Models\Login; 
use App\Models\Referral; 
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function Register(Request $request){
         $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credentials = $request->only('name','email','password','referral');
        $res = [];
        foreach(['email','name'] as $search){
            $temp = User::where($search, $credentials[$search])->count();
            if($temp> 0){
                $res[$search] = ['validation.exist'];
            }
        }
        if(count($res)){
            return response()->json(['error' =>$res]); 
        }
        TempUser::where('email',$credentials['email'])->delete();
        $user = TempUser::updateOrCreate($credentials);

       
        app()->setlocale('fa');
        Mail::send('email.verify', ['code' => $user->code], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject(__('emailVerification'));
        });
       
        return response()->json(['success' => true]); 
    }
    public function Login(Request $request){
         $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $user = User::where('email',$request->email)->where('password',md5($request->password)) ->first();
        if(!$user){
             return response()->json(['error' => 'wrong-user-pass']); 
        }
       
        return  $this->makeLogin($user,$request);
    }
    public function Active(Request $request){
         $validator = Validator::make($request->all(), [ 
            'code' => 'required|regex:/[0-9]{6}/', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }

        $token = TempUser::where('email',$request->email)->orderByDesc('id') ->first();
        if($token){
            if($token->manyTrid()){
                return response()->json(['error' => 'to-many-try']); 
            }
            if($token->isVerified()){
                return response()->json(['error' => 'code-is-used']); 
            }
            if($token->code != $request->code){
                $token->increment('try');
                $token->save();
                 return response()->json(['error' => 'invalid-code']); 
            }
            $token->delete();
            
            $credentials = ['name'=>strtolower($token->name),'email'=>strtolower($token->email),'password'=>$token->password,'lang'=>$token->lang];
            $user = User::updateOrCreate($credentials);   
            if($token->referral != ''){
                $ref = User::where('name',$token->referral) ->first();
                if($user){
                    $credentials = ['user_id'=>$user->id,'referral'=>$ref->id];
                    Referral::updateOrCreate($credentials);   
                }
            }
            return  $this->makeLogin($user,$request);
             
        }
        return response()->json(['error' => 'validation.email']); 
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
        $credentials = $request->only('fullname','tell','lang');
        User::where('id',$request->user->id)
            ->update($credentials);
        return response()->json(['success' =>true]);
    }
    public function ChangePass(Request $request){
        $validator = Validator::make($request->all(), [ 
            'oldPassword' => 'required', 
            'newPassword' => 'required',
        ]);
        
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $user = User::where('id',$request->user->id) ->where('password',md5($request->oldPassword)) ->first();
        if(!$user){
            return response()->json(['error' => 'wrong-user']); 
        }
        $user->password = md5($request->newPassword); 
        $user->save();
        return response()->json(['success' =>true]);
    }
    public function Forget(Request $request){
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>'wrong-user'], 401);            
        }
        $user = User::where('email',$request->email) ->first();
        if(!$user){
            return response()->json(['error' => 'wrong-user']); 
        }
        
        return response()->json(['success' =>true]);
    }

    function makeLogin($user,$request){
        $credentials = ['user_id'=>$user->id,'ip'=> $request->ip()];
        Login::create($credentials);
        $user_data = ['id'=>$user->id];
        $token = $this->generateToken($user_data);
        return response()->json(['success' =>['token'=>$token,'name'=>$user->name,'lang'=>$user->lang]]);
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
