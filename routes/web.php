<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentController;
use App\Models\usuario;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class, 'LoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('signIn', [LoginController::class, 'signInForm'])->name('signIn');

// Route::middleware(['auth:usuario', 'checkUserType:1'])->group(function(){

// Route::resource('payment', PaymentController::class);
Route::get('pagos/principal', [PaymentController::class, 'show']);

// });