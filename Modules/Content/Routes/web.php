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

use Illuminate\Support\Facades\Route;
use Modules\Content\Http\Controllers\AboutUsController;
use Modules\Content\Http\Controllers\ContactController;
use Modules\Content\Http\Controllers\FaqController;
use Modules\Content\Http\Controllers\PostCategoryController;
use Modules\Content\Http\Controllers\PostController;
use Modules\Content\Http\Controllers\ServiceController;
use Modules\Site\Http\Controllers\TeamController;

Route::prefix('admin')->group(function () {
    Route::prefix('content')->group(function () {
        Route::prefix('faq')->group(function () {
            Route::get('/', [FaqController::class, 'index'])->name('admin.content.faq');
            Route::get('/create', [FaqController::class, 'create'])->name('admin.content.faq.create');
            Route::post('/store', [FaqController::class, 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{faq}', [FaqController::class, 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{faq}', [FaqController::class, 'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{faq}', [FaqController::class, 'destroy'])->name('admin.content.faq.destroy');
        });
    });
    Route::prefix('category')->group(function () {
        Route::get('/', [PostCategoryController::class, 'index'])->name('admin.content.category.index');
        Route::get('/create', [PostCategoryController::class, 'create'])->name('admin.content.category.create');
        Route::post('/store', [PostCategoryController::class, 'store'])->name('admin.content.category.store');
        Route::get('/edit/{postCategory}', [PostCategoryController::class, 'edit'])->name('admin.content.category.edit');
        Route::put('/update/{postCategory}', [PostCategoryController::class, 'update'])->name('admin.content.category.update');
        Route::delete('/destroy/{postCategory}', [PostCategoryController::class, 'destroy'])->name('admin.content.category.destroy');
        Route::get('/status/{postCategory}', [PostCategoryController::class, 'status'])->name('admin.content.category.status');
    });

    //post
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.content.post.index');
        Route::get('/create', [PostController::class, 'create'])->name('admin.content.post.create');
        Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store');
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.content.post.edit');
        Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update');
        Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('admin.content.post.destroy');

    });
    Route::get('/messages', [ContactController::class, 'index'])->name('admin.contactus');
    Route::get('/show/{contact}', [ContactController::class, 'show'])->name('admin.contactus.show');

    Route::get('/about-us', [AboutUsController::class, 'index'])->name('admin.about-us');
    Route::get('/edit/{about}', [AboutUsController::class, 'edit'])->name('admin.about-us.edit');
    Route::put('/update/{about}', [AboutUsController::class, 'update'])->name('admin.about-us.update');

    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('admin.service.index');
        Route::get('/create', [ServiceController::class, 'create'])->name('admin.service.create');
        Route::post('/store', [ServiceController::class, 'store'])->name('admin.service.store');
        Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('admin.service.edit');
        Route::put('/update/{service}', [ServiceController::class, 'update'])->name('admin.service.update');
        Route::delete('/destroy/{service}', [ServiceController::class, 'destroy'])->name('admin.service.destroy');
    });

    Route::prefix('team')->namespace('Team')->group(function () {
        Route::prefix('manage-team')->namespace('manage-team')->group(function () {
            Route::prefix('team')->group(function () {
                Route::get('/', [TeamController::class, 'index'])->name('admin.team.index');
                Route::get('/create', [TeamController::class, 'create'])->name('admin.team.create');
                Route::post('/store', [TeamController::class, 'store'])->name('admin.team.store');
                Route::get('/edit/{team}', [TeamController::class, 'edit'])->name('admin.team.edit');
                Route::put('/update/{team}', [TeamController::class, 'update'])->name('admin.team.update');
            });
        });
    });
});

Route::get('/post/{post:slug}', [PostController::class, 'singleBlog'])->name('show.blog');
Route::get('/our-services', [ServiceController::class, 'serviceList'])->name('our-services');
Route::get('/about-us', [AboutUsController::class, 'aboutUs'])->name('about-us');
Route::get('/team-members', [TeamController::class, 'team'])->name('team.members');

Route::get('/blogs', [PostController::class, 'blogs'])->name('blogs');
