<?php

namespace App\Http\Controllers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User; 
use Validator;

const model  = [
    'users'=>User::class
];
class DataController extends Controller
{
    public $successStatus = 200;
    public function List(Request $request){
        if(!array_key_exists($request->table,model)){
            return response()->json(['error' =>true]);
        }
        $res = model[$request->table]::orderBy($request->orderBy == '' ?'id':$request->orderBy, $request->orderDirection == '' ?'DESC':strtoupper ($request->orderDirection));
        $total = $res->count();
        
        $offset = $request->pageSize * ($request->page );
        $res = $res->offset($offset)->limit($request->pageSize);
        $list = $res->get();

        return response()->json(['success' => ['data'=>$list,'total'=>$total,'page'=>$request->page]]);
    }
    public function Add(Request $request){
        if(!array_key_exists($request->table,model)){
            return response()->json(['error' =>true]);
        }
        $credentials = (Array)json_decode($request->data);
        $record = model[$request->table]::create($credentials);
        return response()->json(['success' => $record]);
    }
    public function Update(Request $request){
        if(!array_key_exists($request->table,model)){
            return response()->json(['error' =>true]);
        }
        $credentials = (Array)json_decode($request->data);
        $id = $credentials["id"];
        unset($credentials["id"],$credentials["created_at"],$credentials["updated_at"]);
        model[$request->table]::where('id',$id)->update($credentials);
        return response()->json(['success' => true]);
    }
    public function Delete(Request $request){
        if(!array_key_exists($request->table,model)){
            return response()->json(['error' =>true]);
        }
        model[$request->table]::where('id',$request->id)->delete();
        return response()->json(['success' => true]);
    }

}
