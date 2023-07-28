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

use Modules\Admin\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/admin-users', [AdminController::class, 'AdminUsers'])->name('admin.admin-users');
    Route::get('/admin-manage-users', [AdminController::class, 'AdminManageUsers'])->name('admin.manage-users');
    Route::get('/admin-manage-consultant-users', [AdminController::class, 'AdminManageConsultantUsers'])->name('admin.manage-consultant-users');
    Route::get('/admin-user/create', [AdminController::class, 'create'])->name('admin.admin-user.create');
    Route::post('/admin-user/store', [AdminController::class, 'store'])->name('admin.admin-user.store');
    Route::get('/admin-user/edit/{admin}', [AdminController::class, 'edit'])->name('admin.admin-user.edit');
    Route::put('/admin-user/update/{admin}', [AdminController::class, 'update'])->name('admin.admin-user.update');

    Route::get('/admin-user/authors', [AdminController::class, 'AdminManageAuthorUsers'])->name('admin.user.authors');
    Route::get('/admin-user/is_author/{admin}', [AdminController::class, 'isAuthor'])->name('admin.user.is-author');
    
    Route::get('/roles/{admin}', [AdminController::class, 'roles'])->name('admin.user.admin-user.roles');
    Route::post('/roles/{admin}/store', [AdminController::class, 'rolesStore'])->name('admin.user.admin-user.roles.store');

    Route::get('/permissions/{admin}', [AdminController::class, 'permissions'])->name('admin.user.admin-user.permissions');
    Route::post('/permissions/{admin}/store', [AdminController::class, 'permissionsStore'])->name('admin.user.admin-user.permissions.store');
});
