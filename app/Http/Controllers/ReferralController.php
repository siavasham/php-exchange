<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Referral; 

class ReferralController extends Controller
{
    public $successStatus = 200;

    public function referrals(Request $request){
        $referals = Referral::where('referral',$request->user->id)
        ->get()
        ->map(function ($ref) {
            $ref->referral = $ref->user->name;
            unset( $ref->user);
            return $ref;
        });
        return response()->json(['success' =>$referals]); 
    }
   
}
