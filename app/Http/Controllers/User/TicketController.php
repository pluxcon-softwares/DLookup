<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\Models\TicketReply;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tickets()
    {
        $title = 'Support/Ticket';
        $tickets = Ticket::where('user_id', Auth::user()->id)->get();

        return view('user.tickets')->with(['title'=>$title, 'tickets'=>$tickets]);
    }

    public function ticketCreate(Request $request)
    {
        $request->validate([
            'title'     =>  'required|max:200',
            'body'      =>  'required'
        ]);

        Ticket::create([
            'title' =>  $request->title,
            'body'  =>  $request->body,
            'user_id'   => Auth::user()->id
        ]);

        return redirect()->route('user.tickets')->with('flash_message', 'Thank you for raise a new ticket');
    }

    public function ticketReply($ticket_id)
    {
        $reply = TicketReply::where('ticket_id', $ticket_id)
                            ->where('user_id', Auth::user()->id)
                            ->first();

        return response()->json($reply);
    }

    public function ticketDelete(Request $request)
    {
        $ticket = Ticket::where('user_id', Auth::user()->id)
                            ->where('id', $request->ticket_id)
                            ->first();
        if($ticket->count() > 0)
        {
            $ticket->delete();
            return redirect()->route('user.tickets')
            ->with('flash_message', "Ticket#$request->ticket_id has been deleted!");
        }
        else{
            return back()->with('flash_message', "Ticket #$request->ticket_id was not found!");
        }
    }
}
