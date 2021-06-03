<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\News; 
use Validator;

class NewsController extends Controller
{
    public $successStatus = 200;

    public function Add(Request $request){
         $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'desc' => 'required', 
            'image' => 'required|file', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $image = uniqid().'.'.$img->extension();
            $destinationPath = public_path('/news');
            $img->move($destinationPath, $image);
        };
       
        $credentials = ['title'=>$request->title,'image'=>$image,'desc'=>$request->desc,'text'=>$request->text,'status'=>$request->input('status',true)];
        $news = News::updateOrCreate($credentials);   
        return response()->json(['success' =>true]);
    }
    public function Update(Request $request){
         $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'desc' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credentials = ['title'=>$request->title,'desc'=>$request->desc,'text'=>$request->text,'status'=>$request->input('status',true)];
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $image = uniqid().'.'.$img->extension();
            $destinationPath = public_path('/news');
            $img->move($destinationPath, $image);
            $credentials['image']=$image;

        };
        News::where('id',$request->id)->update($credentials);   
        return response()->json(['success' =>true]);
    }
   
}
