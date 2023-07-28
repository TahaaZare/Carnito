<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticket\Entities\TicketPriorities;
use Modules\Ticket\Http\Requests\TicketPriorities\TicketPrioritiesStore;
use Modules\Ticket\Http\Requests\TicketPriorities\TicketPrioritiesUpdate;

class TicketPrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $priorities = TicketPriorities::all();
        return view('ticket::ticket-priorities.index',compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ticket::ticket-priorities.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TicketPrioritiesStore $request)
    {
        $inputs = $request->all();
        TicketPriorities::create($inputs);
        return redirect()->route('admin.ticket-priorities.index')->with('swal-success','اولویت تیکت جدید با موفقیت ثبت شد');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(TicketPriorities $priorities)
    {
        return view('ticket::ticket-priorities.edit',compact('priorities'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TicketPrioritiesUpdate $request, TicketPriorities $priorities)
    {
        $inputs = $request->all();
        $priorities->update($inputs);
        return redirect()->route('admin.ticket-priorities.index')->with('swal-success','اولویت تیکت جدید با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(TicketPriorities $priorities)
    {
        $result = $priorities->delete();
        return redirect()->route('admin.ticket-priorities.index')->with('swal-warning','عملیات حذفـ با موفقیت انجام شد');
    }
}
