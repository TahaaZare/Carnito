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
use Modules\Ticket\Http\Controllers\TicketAdminController;
use Modules\Ticket\Http\Controllers\TicketCategoryController;
use Modules\Ticket\Http\Controllers\TicketController;
use Modules\Ticket\Http\Controllers\TicketPrioritiesController;

Route::prefix('admin')->group(function () {
    Route::prefix('ticket')->group(function () {

        Route::get('/new-tickets', [TicketController::class, 'newTickets'])->name('admin.ticket.newTickets');
        Route::get('/open-tickets', [TicketController::class, 'openTickets'])->name('admin.ticket.openTickets');
        Route::get('/close-tickets', [TicketController::class, 'closeTickets'])->name('admin.ticket.closeTickets');

        Route::get('/', [TicketController::class, 'index'])->name('admin.ticket.index');
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('admin.ticket.show');
        Route::post('/answer/{ticket}', [TicketController::class, 'answer'])->name('admin.ticket.answer');
        Route::get('/change/{ticket}', [TicketController::class, 'change'])->name('admin.ticket.change');

        //ticket admin
        Route::get('/ticket-admin', [TicketAdminController::class, 'index'])->name('admin.ticket.admin.index');
        Route::get('/set/{admin}', [TicketAdminController::class, 'set'])->name('admin.ticket.admin.set');

        Route::prefix('ticket-category')->group(function () {
            Route::get('/', [TicketCategoryController::class, 'index'])->name('admin.ticket-category.index');
            Route::get('/create', [TicketCategoryController::class, 'create'])->name('admin.ticket-category.create');
            Route::post('/store', [TicketCategoryController::class, 'store'])->name('admin.ticket-category.store');
            Route::get('/edit/{category}', [TicketCategoryController::class, 'edit'])->name('admin.ticket-category.edit');
            Route::put('/update/{category}', [TicketCategoryController::class, 'update'])->name('admin.ticket-category.update');
            Route::delete('/destroy/{category}', [TicketCategoryController::class, 'destroy'])->name('admin.ticket-category.destroy');
        });

        Route::prefix('ticket-priorities')->group(function () {
            Route::get('/', [TicketPrioritiesController::class, 'index'])->name('admin.ticket-priorities.index');
            Route::get('/create', [TicketPrioritiesController::class, 'create'])->name('admin.ticket-priorities.create');
            Route::post('/store', [TicketPrioritiesController::class, 'store'])->name('admin.ticket-priorities.store');
            Route::get('/edit/{priorities}', [TicketPrioritiesController::class, 'edit'])->name('admin.ticket-priorities.edit');
            Route::put('/update/{priorities}', [TicketPrioritiesController::class, 'update'])->name('admin.ticket-priorities.update');
            Route::delete('/destroy/{priorities}', [TicketPrioritiesController::class, 'destroy'])->name('admin.ticket-priorities.destroy');
        });
    });
});

