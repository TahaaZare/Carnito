<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\AdminUserRequest;
use Modules\Permission\Database\Seeders\PermissionDatabaseSeeder;
use Modules\Permission\Entities\Permission;
use Modules\Role\Database\Seeders\RoleDatabaseSeeder;
use Modules\Role\Entities\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('admin-panel')) {
            #region role

            $role = Role::first();
            if ($role === null) {
                $default  = new RoleDatabaseSeeder();
                $default->run();
            }


            #endregion
            #region permissions

            $permission = Permission::first();
            if ($permission === null) {
                $default  = new PermissionDatabaseSeeder();
                $default->run();
            }

            #endregion
           
            $user_list = User::all();
            $admin_user_list = User::where('user_type',1)->get();
            return view('admin::index',compact('user_list','admin_user_list'));
        }
        abort(403);
    }

    public function AdminManageUsers()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('manage-admin-users')) {
            $admins = User::where('user_type', 0)->simplePaginate(10);
            $dNone = true;
            return view('admin::admin-users', compact('admins', 'dNone'));
        }
        abort(403);
    }
    public function AdminUsers()
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('manage-admin-users')) {
            $admins = User::where('user_type', 1)->simplePaginate(10);
            $dNone = false;
            return view('admin::admin-users', compact('admins', 'dNone'));
        }

        abort(403);
    }

    public function isAuthor(User $admin)
    {
        $admin->is_author = $admin->is_author == 0 ? 1 : 0;
        $result = $admin->save();
        if ($result) {
            return redirect()->back()->with('swal-success', '  وضعیت  با موفقیت تغییر کرد');
        } else {
            return redirect()->back()->with('swal-error', '  وضعیت  با خطا مواجه شد');
        }
    }
    public function AdminManageAuthorUsers(User $admin)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('manage-admin-users')) {
            $admins = User::where('is_author', 1)->simplePaginate(10);
            $dNone = true;
            return view('admin::admin-users', compact('admins', 'dNone'));
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
            return redirect()->route('auth.login-register');
        }
        if ($user->can('create-user')) {

            return view('admin::create');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(AdminUserRequest $request, ImageService $imageService)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('create-user')) {

            $inputs = $request->all();
            if ($request->hasFile('profile_photo_path')) {
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
                $result = $imageService->save($request->file('profile_photo_path'));

                if ($result === false) {
                    return redirect()->route('admin.admin-users')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['profile_photo_path'] = $result;
            }
            $inputs['password'] = Hash::make($request->password);
            $inputs['user_type'] = 1;
            $user = User::create($inputs);
            return redirect()->route('admin.admin-users')->with('swal-success', 'ادمین جدید با موفقیت ثبت شد');
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $admin)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('edit-user')) {

            return view('admin::edit', compact('admin'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(AdminUserRequest $request, User $admin, ImageService $imageService)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('edit-user')) {

            $inputs = $request->all();

            if ($request->hasFile('profile_photo_path')) {
                if (!empty($admin->profile_photo_path)) {
                    $imageService->deleteImage($admin->profile_photo_path);
                }
                $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'users');
                $result = $imageService->save($request->file('profile_photo_path'));
                if ($result === false) {
                    return redirect()->route('admin.admin-users')->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
                }
                $inputs['profile_photo_path'] = $result;
            }
            $admin->update($inputs);
            return redirect()->route('admin.admin-users')->with('swal-success', 'ادمین سایت شما با موفقیت ویرایش شد');
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

    #region roles

    public function roles(User $admin)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('manage-roles')) {

            $roles = Role::where('status', 1)->get();
            return view('admin::roles', compact('admin', 'roles'));
        }
        abort(403);
    }

    public function rolesStore(Request $request, User $admin)
    {
        $validated = $request->validate([
            'roles' => 'exists:roles,id|array'
        ]);

        $admin->roles()->sync($request->roles);
        return redirect()->route('admin.admin-users')->with('swal-success', 'نقش با موفقیت ویرایش شد');
    }

    #endregion

    #region permissions

    public function permissions(User $admin)
    {
        $user = auth()->user();
        if ($user == null) {
            return redirect()->route('auth.login-register');
        }
        if ($user->can('edit-role-permission')) {

            $permissions = Permission::where('status', 1)->get();
            return view('admin::permissions', compact('admin', 'permissions'));
        }
        abort(403);
    }

    public function permissionsStore(Request $request, User $admin)
    {
        $validated = $request->validate([
            'permissions' => 'exists:permissions,id|array'
        ]);
        $admin->permissions()->sync($request->permissions);
        return redirect()->route('admin.admin-users')->with('swal-success', 'دسترسی با موفقیت ویرایش شد');
    }

    #endregion
}
