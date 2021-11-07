<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;


class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function add_event(Request $request){
      
        $event                          = new Event();
        $event->event_name              = $request->event_name;
        $event->event_description       = $request->event_description;
        $event->event_start_date        = date('Y-m-d',strtotime($request->event_start_date));
        $event->event_end_date          = date('Y-m-d',strtotime($request->event_end_date));
        $event->event_organizer         = $request->event_organizer;
        $event->save();
    }
    public function add_ticket(Request $request){
            
            $ticket_id       = $request->ticket_id;
            $event_id       = $request->event_id;
            $ticket_number  = $request->ticket_number;
            $ticket_price   = $request->ticket_price;
            $ticket         = new Ticket();
            $ticket->event_id       = $event_id;
            $ticket->ticket_number  = $ticket_number;
            $ticket->price          = $ticket_price;
            $ticket->save();
            return response()->json([
                'ticket_id' => $ticket_id,
                'ticket_number' => $ticket_price,
                'ticket_price' => $ticket_price
            ]);
    }
    
    public function index()
    {
        $event_count = Event::count();
        if($event_count == 0){
            $event_id = 1;
        }else{
             $data = Event::latest('id')->first();
             $event_id = $data->id;
        }
        $ticket_count = Ticket::count();
        $tickets = Ticket::all();
        return view('event.index',compact('event_id','ticket_count','tickets'));
    }
}
