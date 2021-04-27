<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Ticket; 
use App\Models\TicketMsg; 
use Validator;

class TicketController extends Controller
{
    public $successStatus = 200;

    public function tickets(Request $request){
        $tickets = Ticket::where('user_id', $request->user->id)->reorder('id', 'desc')->get();
        return response()->json(['success' =>$tickets]); 
    }
    public function newTicket(Request $request){
        $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'text' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credentials = ['user_id'=>$request->user->id,'title'=>$request->title];
        $ticket = Ticket::create($credentials);
        $credentials = ['user_id'=>$request->user->id,'ticket_id'=>$ticket->id,'text'=>$request->text];
        $ticketMsg = TicketMsg::create($credentials);
        return response()->json(['success' => true]); 
    }
   
    public function replayTicket(Request $request){
        $validator = Validator::make($request->all(), [ 
            'ticket' => 'required', 
            'text' => 'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $credentials = ['user_id'=>$request->user->id,'ticket_id'=>$request->ticket,'text'=>$request->text];
        $ticketMsg = TicketMsg::create($credentials);
        return response()->json(['success' => true]); 
    }
    public function viewTicket(Request $request){
        $validator = Validator::make($request->all(), [ 
            'ticket' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
         $ticket =Ticket::where('user_id',$request->user->id)
                ->where('id',$request->ticket)
                ->get()
                ->map(function ($ref) {
                    $ref->messages = $ref->messages;
                    return $ref;
                });
        return response()->json(['success' => $ticket[0]]); 
    }
   
}
