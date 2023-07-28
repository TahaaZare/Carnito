<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Role\Http\Controllers\RoleController;

Route::prefix('admin')->group(function () {
    Route::prefix('role')->group(function () {
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('/update/{role}', [RoleController::class, 'update'])->name('admin.role.update');

        Route::get('/role-permission/{role}', [RoleController::class, 'rolePermission'])->name('admin.user.role.role-permission');
        Route::put('/updateRolePermission/{role}', [RoleController::class, 'updateRolePermission'])->name('admin.user.role.updateRolePermission');
    });
});