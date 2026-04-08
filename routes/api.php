<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::resource('/tickets', TicketController::class);
Route::get('/tickets/statistics/{user_id}', [TicketController::class, 'statistics'])->name('tickets.statistics');
