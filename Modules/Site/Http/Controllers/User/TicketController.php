<?php

namespace Modules\Site\Http\Controllers\User;

use App\Http\Services\File\FileService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Site\Http\Requests\User\StoreTicketUserRequest;
use Modules\Site\Http\Requests\User\TicketRequest;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Entities\TicketCategory;
use Modules\Ticket\Entities\TicketFile;
use Modules\Ticket\Entities\TicketPriorities;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        $tickets = auth()->user()->tickets->where('ticket_id', null);
        return view('site::profile.tickets', compact('tickets'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        $ticketCategories = TicketCategory::all();
        $ticketPriorities = TicketPriorities::all();
        return view('site::profile.create-ticket', compact('ticketCategories', 'ticketPriorities'));
    }

    public function store(StoreTicketUserRequest $request, FileService $fileService)
    {

        DB::transaction(function () use ($request, $fileService) {
            //ticket body
            $inputs = $request->all();
            $inputs['user_id'] = auth()->user()->id;
            $ticket = Ticket::create($inputs);

            //ticket file
            if ($request->hasFile('file')) {
                $fileService->setExclusiveDirectory('files' . DIRECTORY_SEPARATOR . 'ticket-files');
                $fileService->setFileSize($request->file('file'));
                $fileSize = $fileService->getFileSize();
                $result = $fileService->moveToPublic($request->file('file'));
                // $result = $fileService->moveToStorage($request->file('file'));
                $fileFormat = $fileService->getFileFormat();
                $inputs['ticket_id'] = $ticket->id;
                $inputs['file_path'] = $result;
                $inputs['file_size'] = $fileSize;
                $inputs['file_type'] = $fileFormat;
                $inputs['user_id'] = auth()->user()->id;
                $file = TicketFile::create($inputs);
            }
        });


        return redirect()->route('customer.profile.my-tickets')->with('swal-success', '  تیکت شما با موفقیت ثبت شد');
    }
    public function show(Ticket $ticket)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        return view('site::profile.show-ticket', compact('ticket'));
    }

    public function change(Ticket $ticket)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($ticket->status == 0) {
            $ticket->status = 1;
        }
        $result = $ticket->save();
        return redirect()->back()->with('swal-success', 'تغییر شما با موفقیت انجام شد');
    }
    public function answer(TicketRequest $request, Ticket $ticket)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        $inputs = $request->all();
        $inputs['subject'] = $ticket->subject;
        $inputs['description'] = $request->description;
        $inputs['seen'] = 0;
        $inputs['reference_id'] = $ticket->reference_id;
        $inputs['user_id'] = auth()->user()->id;
        $inputs['category_id'] = $ticket->category_id;
        $inputs['priority_id'] = $ticket->priority_id;
        $inputs['ticket_id'] = $ticket->id;
        $ticket = Ticket::create($inputs);
        return redirect()->back()->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');
    }
}
