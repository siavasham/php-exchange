<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Kyc; 
use App\Models\User; 
use Validator;

class LevelController extends Controller
{
    public $successStatus = 200;

    public function Kyc(Request $request){
         $validator = Validator::make($request->all(), [ 
            'cart' => 'required|file', 
            'img' => 'required|file', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        if ($request->hasFile('cart')) {
            $image = $request->file('cart');
            $cart = uniqid().'.'.$image->extension();
            $destinationPath = public_path('/verify//'.$request->user->id);
            $image->move($destinationPath, $cart);
        };
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $img = uniqid().'.'.$image->extension();
            $destinationPath = public_path('/verify//'.$request->user->id);
            $image->move($destinationPath, $img);
        };
        $credentials = ['user_id'=>$request->user->id,'cart'=>$cart,'img'=>$img];
        $wallet = Kyc::updateOrCreate($credentials);   
        return response()->json(['success' =>true]);
    }
    public function Level(Request $request){
        $level = Kyc::where('user_id',$request->user->id)->first();
        return response()->json(['success' =>$level]); 
    }
   
}
