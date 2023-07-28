<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\Faq;
use Modules\Content\Http\Requests\FaqRequest;
use Symfony\Component\Console\Input\Input;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('content::faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('content::faq.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(FaqRequest $request)
    {
        $inputs =  $request->all();


        Faq::create($inputs);

        return redirect()->route('admin.content.faq')->with('swal-success', 'سوال شما با موفقیت ثبت شد ');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('content::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Faq $faq)
    {
        return view('content::faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $inputs =  $request->all();
        $faq->update($inputs);
        return redirect()->route('admin.content.faq')->with('swal-success', "سوال $faq->question با موفقیت ویرایش شد");
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Faq $faq)
    {
        $result = $faq->delete();
        return redirect()->route('admin.content.faq')->with('swal-warning','عملیات حذفـ با موفقیت انجام شد');
    }
}
