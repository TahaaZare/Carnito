<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Permission\Entities\Permission;
use Modules\Role\Entities\Role;
use Modules\Role\Http\Requests\CreateRoleRequest;
use Modules\Role\Http\Requests\EditRoleRequest;
use Modules\Role\Http\Requests\RolePermissionRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $roles = Role::where('deleted_at',null)->simplePaginate(10);
        return view('role::index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permissions  = Permission::all();
        return view('role::create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateRoleRequest $request)
    {
        $inputs = $request->all();
        $role_exist = Role::get();

        foreach ($role_exist as  $r) {
            if ($r->name == $inputs['name']) {
                $inputs['name'] =  $inputs['name'] . '-1';
            }
        }

        $role = Role::create($inputs);

        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);

        return redirect()->route('admin.roles')->with('swal-success', 'نقش جدید با موفقیت ثبت شد');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Role $role)
    {
        return view('role::edit', compact('role'));
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(EditRoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        return redirect()->route('admin.roles')->with('swal-success', 'نقش  با موفقیت ویرایش شد');
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

    public function rolePermission(Role $role)
    {
        $permissions  = Permission::all();
        return view('role::role-permission', compact('role', 'permissions'));
    }


    public function updateRolePermission(RolePermissionRequest $request, Role $role)
    {
        $inputs = $request->all();
        $inputs['permissions'] = $inputs['permissions'] ?? [];
        $role->permissions()->sync($inputs['permissions']);
        return redirect()->route('admin.roles')->with('swal-success', 'دسترسی نقش با موفقیت ویرایش شد');
    }
}