<?php

namespace Modules\Content\Http\Controllers;

use App\Http\Services\Image\ImageService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Content\Entities\Service;
use Modules\Content\Http\Requests\Service\EditServiceRequest;
use Modules\Content\Http\Requests\Service\StoreServiceRequest;

class ServiceController extends Controller
{
    public function serviceList()
    {
        $services = Service::simplePaginate(10);
        return view('content::services.service-list', compact('services'));
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        } else if ($user->can('manage-services')) {
            $services = Service::simplePaginate(10);
            return view('content::services.index', compact('services'));
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
        } else if ($user->can('create-service')) {
            return view('content::services.create');
        }
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreServiceRequest $request, ImageService $imageService)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        } else if ($user->can('create-service')) {
            $inputs = $request->all();
            if ($request->hasFile('image')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'services');
                $result = $imageService->save($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.service.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['image'] = $result;
            }
            $service = Service::create($inputs);

            return redirect()->route('admin.service.index')->with('swal-success', 'سرویس جدید با موفقیت ثبت شد.');
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Service $service)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        } else if ($user->can('edit-service')) {
            return view('content::services.edit', compact('service'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(EditServiceRequest $request, ImageService $imageService, Service $service)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-form');
        } else if ($user->can('edit-service')) {
            $inputs = $request->all();
            if ($request->hasFile('image')) {
                if (!empty($post->image)) {
                    $imageService->deleteImage($post->image);
                }
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'posts');
                $result = $imageService->save($request->file('image'));
                if ($result === false) {
                    return redirect()->route('admin.content.post.index')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['image'] = $result;
            }
            $service->update($inputs);
            return redirect()->route('admin.service.index')->with('swal-success', 'سرویس  با موفقیت ویرایش شد.');
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
