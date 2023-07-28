<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Http\Requests\TicketRequest;

class TicketController extends Controller
{
    public function newTickets()
    {
        $tickets = Ticket::where('seen', 0)->where('ticket_id',null)->simplePaginate(5);
        foreach ($tickets as  $new_ticket) {
            $new_ticket->seen = 1;
            $result = $new_ticket->save();
        }
        return view('ticket::index', compact('tickets'));
    }
    public function openTickets()
    {
        $tickets = Ticket::where('status', 0)->where('ticket_id',null)->simplePaginate(5);
        return view('ticket::index', compact('tickets'));
    }
    public function closeTickets()
    {
        $tickets = Ticket::where('status', 1)->where('ticket_id',null)->simplePaginate(5);
        return view('ticket::index', compact('tickets'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $tickets = Ticket::orderBy('created_at', 'desc')->where('ticket_id',null)->simplePaginate(10);
        return view('ticket::index', compact('tickets'));
    }

    public function change(Ticket $ticket)
    {
        $ticket->status = $ticket->status == 0 ? 1 : 0;
        $result = $ticket->save();
        if ($result) {
            if ($ticket->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }
    }
    public function show(Ticket $ticket)
    {
        return view('ticket::show',compact('ticket'));
    }

    public function answer(TicketRequest $request, Ticket $ticket)
    {

        $ticketAdmin = auth()->user()->ticketAdmin;
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 1;
        $inputs['reference_id'] = $ticketAdmin->id;
        $inputs['user_id'] =  $ticket->user_id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        $ticket = Ticket::create($inputs);
        return redirect()->route('admin.ticket.index')->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');
    }

}
