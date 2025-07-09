<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaymentController;
use App\Models\usuario;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class, 'LoginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('signIn', [LoginController::class, 'signInForm'])->name('signInForm');
Route::post('signIn', [LoginController::class, 'sigIn'])->name('signIn');

Route::middleware(['auth:usuario'])->group(function(){
    Route::get('menu-principal', [MainController::class, 'show'])->name('main');
    Route::get('perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('perfil/{usuario}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('perfil/{usuario}/cambiar-correo', [ProfileController::class, 'changeEmail'])->name('change.email');
    Route::put('perfil/{usuario}/cambiar-contraseña', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::delete('perfil/{usuario}', [ProfileController::class, 'delete'])->name('delete.account');
});

Route::middleware(['auth:usuario', 'check.user.type:1'])->group(function(){

});