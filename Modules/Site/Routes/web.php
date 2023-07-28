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
use Modules\Content\Entities\ContactUs;
use Modules\Content\Http\Controllers\ContactController;
use Modules\Counseling\Http\Controllers\CounselingController;
use Modules\Site\Http\Controllers\Auth\LoginController;
use Modules\Site\Http\Controllers\Auth\LoginRegisterController;
use Modules\Site\Http\Controllers\Auth\RegisterController;
use Modules\Site\Http\Controllers\HomeController;
use Modules\Site\Http\Controllers\SalesProcess\CartController;
use Modules\Site\Http\Controllers\SalesProcess\CustomerPaymentController;
use Modules\Site\Http\Controllers\User\ProfileCompletionController;
use Modules\Site\Http\Controllers\User\ProfileController;
use Modules\Site\Http\Controllers\User\ProfileOrderController;
use Modules\Site\Http\Controllers\User\TicketController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('contact')->group(function () {
    Route::post('/store', [ContactController::class, 'store'])->name('contactUs.store');
});


Route::namespace('Auth')->group(function () {
    // Route::get('login-register', [LoginRegisterController::class, 'loginRegisterForm'])->name('auth.login-register-form');
    // Route::middleware('throttle:customer-login-register-limiter')->post('/login-register', [LoginRegisterController::class, 'loginRegister'])->name('auth.login-register');
    // Route::get('login-confirm/{token}', [LoginRegisterController::class, 'loginConfirmForm'])->name('auth.login-confirm-form');
    // Route::middleware('throttle:customer-login-confirm-limiter')->post('/login-confirm/{token}', [LoginRegisterController::class, 'loginConfirm'])->name('auth.login-confirm');
    // Route::middleware('throttle:customer-login-resend-otp-limiter')->get('/login-resend-otp/{token}', [LoginRegisterController::class, 'loginResendOtp'])->name('auth.login-resend-otp');

    Route::get('register', [RegisterController::class, 'registerForm'])->name('auth.regitser-form');
    Route::post('/register', [RegisterController::class, 'register'])->name('auth.regitser');

    Route::get('login', [LoginController::class, 'loginForm'])->name('auth.login-form');
    Route::post('/login-user ', [LoginController::class, 'login'])->name('auth.user.login');

    Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('user.logout');
});
Route::post('/add-comment/post/{post:slug}', [CommentController::class, 'addComment'])->name('post.add-comment');

Route::prefix('contact')->group(function () {
    Route::get('/contact-us', [ContactController::class, 'showForm'])->name('contactUs');
    Route::post('/store', [ContactController::class, 'store'])->name('contactUs.store');
});

Route::namespace('Profile')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('customer.profile.profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('customer.profile.profile.update');

    Route::get('/my-tickets', [TicketController::class, 'index'])->name('customer.profile.my-tickets');
    Route::get('/ticket-show/{ticket}', [TicketController::class, 'show'])->name('customer.profile.show-ticket');
    Route::post('/ticket-answer/{ticket}', [TicketController::class, 'answer'])->name('customer.profile.answer');
    Route::get('/ticket-change/{ticket}', [TicketController::class, 'change'])->name('customer.profile.change');
    Route::get('my-tickets/create', [TicketController::class, 'create'])->name('customer.profile.my-tickets.create');
    Route::post('my-tickets/store', [TicketController::class, 'store'])->name('customer.profile.my-tickets.store');
});
