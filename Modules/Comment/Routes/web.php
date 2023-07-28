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
use Modules\Comment\Http\Controllers\CommentController;

Route::prefix('admin')->group(function () {
    Route::prefix('content')->group(function () {
        Route::prefix('comments')->group(function () {
            Route::get('/post-comments', [CommentController::class, 'postIndex'])->name('admin.content.posts-comments.index');
            Route::get('/posts/comment/show/{comment}', [CommentController::class, 'postShow'])->name('admin.content.post-comment.show');
            Route::get('/posts/comment/approved/{comment}', [CommentController::class, 'postApproved'])->name('admin.content.comment.post-comment.approved');
            Route::get('/post/comment/status/{comment}', [CommentController::class, 'postStatus'])->name('admin.content.comment.post-comment.status');
            Route::post('/answer/{comment}', [CommentController::class, 'postAnswer'])->name('admin.content.comment.post-answer');

        });
    });
});
