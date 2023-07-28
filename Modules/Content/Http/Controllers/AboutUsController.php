<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Database\Seeders\AboutUsSeedDataBaseTableSeeder;
use Modules\Content\Entities\AboutUs;
use Modules\Content\Http\Requests\AboutUsRequest;

class AboutUsController extends Controller
{

    public function aboutUs(){
        $messages = AboutUs::all();
        return view('content::about-us.about-us', compact('messages'));
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $about = AboutUs::first();
        if ($about === null) {
            $default  = new AboutUsSeedDataBaseTableSeeder();
            $default->run();
        }
        $messages = AboutUs::all();
        return view('content::about-us.index', compact('messages'));
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
    public function edit(AboutUs $about)
    {
        return view('content::about-us.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(AboutUsRequest $request, AboutUs $about)
    {
        $inputs = $request->all();

        $about->update($inputs);
        return redirect()->route('admin.about-us')->with('swal-success','متن با موفقیت ویرایش شد');
    }
}
