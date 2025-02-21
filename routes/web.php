<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PaymentController::class, 'show'])->name('payment.form');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.process');
Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');

Route::get('/proccessed', [PaymentController::class, 'proccessed'])->name('payment.proccessed');
