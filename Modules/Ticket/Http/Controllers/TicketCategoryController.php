<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ticket\Entities\TicketCategory;
use Modules\Ticket\Http\Requests\TicketCategory\TicketCategoryStore;
use Modules\Ticket\Http\Requests\TicketCategory\TicketCategoryUpdate;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $ticketCategories = TicketCategory::orderBy('created_at', 'desc')->simplePaginate(10);
        return view('ticket::ticket-category.index', compact('ticketCategories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ticket::ticket-category.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TicketCategoryStore $request)
    {
        $inputs = $request->all();
        TicketCategory::create($inputs);
        return redirect()->route('admin.ticket-category.index')->with('swal-success', 'دسته جدید تیکت با موفقیت ثبت شد');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(TicketCategory $category)
    {
        return view('ticket::ticket-category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TicketCategoryUpdate $request, TicketCategory $category)
    {
        $inputs = $request->all();
        $category->update($inputs);
        return redirect()->route('admin.ticket-category.index')->with('swal-success', 'دسته جدید تیکت با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(TicketCategory $category)
    {
        $result = $category->delete();
        return redirect()->route('admin.ticket-category.index')->with('swal-warning','عملیات حذفـ با موفقیت انجام شد');
    }
}
