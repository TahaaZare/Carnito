<?php

namespace Modules\Site\Http\Controllers;

use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\Team;
use Modules\Site\Http\Requests\TeamRequest;

class TeamController extends Controller
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
        if ($user->can('manage-teams')) {
            $teams = Team::where('deleted_at', null)->simplePaginate(10);
            return view('site::team.index', compact('teams'));
        }
        return abort(403);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('create-team')) {
            return view('site::team.create');
        }
        return abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request, ImageService $imageService)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('create-team')) {
            $inputs = $request->all();
            #region image

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'teams');
                $result = $imageService->save($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.team.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['image'] = $result;
            }

            #endregion

            $team = Team::create($inputs);
            return redirect()->route('admin.team.index')->with('swal-success', 'عضو جدید با موفقیت ثبت شد');
        }
        return abort(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('create-team')) {
            return view('site::team.edit', compact('team'));
        }
        return abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, Team $team, ImageService $imageService)
    {

        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        }
        if ($user->can('create-team')) {

            $inputs = $request->all();
            #region image

            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'teams');
                $result = $imageService->save($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.team.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['image'] = $result;
            }

            #endregion
            $team->update($inputs);
            return redirect()->route('admin.team.index')->with('swal-success', 'عضو تیم شما با موفقیت ویرایش شد');
        }
        return abort(403);
        $inputs = $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function team()
    {
        $teams = Team::where('status', 1)->simplePaginate(10);
        return view('site::team.team-list', compact('teams'));
    }
}
