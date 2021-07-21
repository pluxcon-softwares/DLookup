<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Models\Ticket;
use App\Models\TicketReply;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function getTickets()
    {
        $title = 'Support/Ticket';
        $tickets = Ticket::all();
        return view('admin.ticket.all')->with(['title' => $title, 'tickets'=>$tickets]);
    }

    public function replyTicket(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'reply' =>  'required'
        ]);

        if($validate->fails())
        {
            return response()->json(['error' => true, 'error_msg' => $validate->errors()]);
        }

        $ticket_id = $request->ticket_id;
        $user_id = Auth::guard('admin')->user()->id;
        $reply = $request->reply;

        TicketReply::create([
            'user_id'   =>  $user_id,
            'ticket_id' =>  $ticket_id,
            'reply'     =>  $reply
        ]);

        $ticket_replied = Ticket::find($ticket_id);
        $ticket_replied->is_replied = 1;
        $ticket_replied->save();

        return response()->json(['success' => true]);
    }

    public function viewTicket($ticket_id)
    {
        $ticket = Ticket::with('user:id,username')->where('id', $ticket_id)->first();
        return response()->json($ticket);
    }

    public function deleteTicket(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        if($ticket->count() > 0)
        {
            $ticket->delete();
            return redirect()->route('admin.tickets')
            ->with('flash_message', "Ticket ID:#$request->ticket_id has been deleted!");
        }
    }
}
