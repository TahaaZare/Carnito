<?php

namespace Modules\Ticket\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Modules\Ticket\Entities\TicketAdmin;

class TicketAdminController extends Controller
{
    public function index()
    {
        $admins = User::where('user_type', 1)->simplePaginate(10);
        return view('ticket::admin-ticket.index', compact('admins'));
    }

    public function set(User $admin)
    {
        TicketAdmin::where('user_id', $admin->id)->first() ? TicketAdmin::where(['user_id' => $admin->id])->forceDelete() : TicketAdmin::create(['user_id' => $admin->id]);
        return redirect()->route('admin.ticket.admin.index')->with('swal-success', 'عملیات با موفقیت انجام شد');
    }
}
