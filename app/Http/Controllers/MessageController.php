<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Message; 
use Validator;

class MessageController extends Controller
{
    public $successStatus = 200;

    public function List(Request $request){
        $messages = Message::where('user_id',$request->user->id)->orWhere('user_id',0)->get();
        return response()->json(['success' =>$messages]); 
    }
   
}
