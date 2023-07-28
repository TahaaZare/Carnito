<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\ContactUs;
use Modules\Content\Http\Requests\ContactRequest;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showForm(){
        return view('content::contact-us.show-form');
    }
    public function index()
    {
        $user  = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-confirm-form');
        } elseif ($user != null && $user->can('manage-messages')) {
            $messages = ContactUs::simplePaginate(5);
            return view('content::contact-us.index', compact('messages'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ContactRequest $request)
    {
        $inputs = $request->all();
        ContactUs::create($inputs);
        return redirect()->route('home')->with('swal-success', 'پیام شما با موفقیت ارسال شد .');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(ContactUs $contact)
    {
        $user  = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-confirm-form');
        } elseif ($user != null && $user->can('show-messages')) {
            return view('content::contact-us.show', compact('contact'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('contact::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
