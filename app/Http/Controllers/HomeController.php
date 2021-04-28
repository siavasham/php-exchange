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
        app()->setlocale('fa');
        return view('home');
    }


    
}

