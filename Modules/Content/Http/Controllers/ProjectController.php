<?php

namespace Modules\Content\Http\Controllers;

use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\Projcet\Project;
use Modules\Content\Entities\Projcet\ProjectCategory;
use Modules\Content\Http\Requests\Project\StoreProjectRequest;
use Modules\Content\Http\Requests\Project\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function allProjects(){
        $projects = Project::where('status',1)->paginate(6);
        return view('site.layouts.projects.index',compact('projects'));
    }
    public function show(Project $project){
        return view('site.layouts.projects.show-project',compact('project'));
    }
    public function index()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            $projects = Project::simplePaginate(10);
            return view('content::project.index', compact('projects'));
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
            $categories = ProjectCategory::all();
            return view('content::project.create', compact('categories'));
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreProjectRequest $request, ImageService $imageService)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            $inputs = $request->all();
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'projects');
                $result = $imageService->save($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.project.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['image'] = $result;
            }
            $project = Project::create($inputs);
            return redirect()->route('admin.project.index')->with('swal-success', 'پروژه  جدید شما با موفقیت ثبت شد');
        }
        abort(403);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Project $project)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            $categories = ProjectCategory::all();
            return view('content::project.edit', compact('project', 'categories'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateProjectRequest $request, Project $project, ImageService $imageService)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('developer')) {
            if (!empty($project->image)) {
                $imageService->deleteImage($project->image);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'projects');
            $result = $imageService->save($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.project.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;

            $u_post = $project->update($inputs);
            return redirect()->route('admin.project.index')->with('swal-success', 'پروژه   شما با موفقیت ویرایش شد');
        }
        abort(403);
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
