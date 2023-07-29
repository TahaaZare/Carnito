<?php

namespace Modules\Content\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\Projcet\ProjectCategory;
use Modules\Content\Http\Requests\Project\ProjectCategoryRequest;

class ProjectCategoryController extends Controller
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
        if ($user->can('developer')) {
            $categories = ProjectCategory::simplePaginate(10);
            return view('content::project-category.index', compact('categories'));
        }
        abort(403);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            return view('content::project-category.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ProjectCategoryRequest $request)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            $inputs = $request->all();
            ProjectCategory::create($inputs);
            return redirect()->route('admin.project-category.index')->with('swal-success','دسته جدید با موفقیت ثبت شد');
        }
        abort(403);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ProjectCategory $category)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            return view('content::project-category.edit',compact('category'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProjectCategoryRequest $request,ProjectCategory $category)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            $inputs = $request->all();
            $category->update($inputs);
            return redirect()->route('admin.project-category.index')->with('swal-success','دسته  با موفقیت ویرایش شد');
        }
        abort(403);
    }
}
