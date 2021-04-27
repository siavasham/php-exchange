<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Plan; 
use App\Models\Faq; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if($request->has('lang')){
            $lang = $request->input('lang','en');
        }
        else{
            $userLocales = $request->getLanguages();
            if(in_array('fa',$userLocales)){
                $lang = 'fa';
            }
            else{
              $lang = 'en';  
            }
        }
        app()->setlocale($lang);
        $user = (object) [ 'isRtl'=> in_array($lang,['fa','ar']),'lang'=>$lang];
        $plans = Plan::where('status', true)->get();
        $faq = Faq::where('lang', $lang)->get();
        return view('home',['user'=>$user,'plans'=>$plans,'faq'=>$faq]);
    }


    
}

