<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Charges\ChargesController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\AccountController;

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

    Route::middleware(['check.user.type:3,2,1'])->group(function(){
        Route::get('lista-alumnos/{padre}', [PaymentController::class, 'studentList'])->name('payments.student');
        Route::get('registro-pagos/{alumno}', [PaymentController::class, 'paymentRegister'])->name('payment.register');
    });

    Route::middleware(['check.user.type:2,1'])->group(function(){
        Route::get('lista-padres', [ChargesController::class, 'parentsList'])->name('charges.parents');
        Route::get('buscar-padres', [ChargesController::class, 'searchParents'])->name('search.parents');
        Route::get('lista-estudiantes', [ChargesController::class, 'studentsList'])->name('charges.students');
        Route::get('buscar-estudiantes', [ChargesController::class, 'searchStudent'])->name('search.students');
        Route::resource('estudiantes', StudentController::class)
            ->except(['create', 'edit', 'show'])
            ->names('students');
        Route::get('buscar-estudiante', [StudentController::class, 'searchStudent'])->name('search.student');
        Route::put('editar-pago/{pago}', [PaymentController::class, 'updatePayment'])->name('payment.update');

    });

    Route::middleware(['check.user.type:1'])->group(function(){
        Route::post('guardar-pago', [PaymentController::class, 'storePayment'])->name('payment.store');
        Route::delete('eliminar-pago/{pago}', [PaymentController::class, 'destroyPayment'])->name('payment.destroy');
        Route::resource('precios', PriceController::class)
            ->except(['create', 'edit', 'show'])
            ->names('prices');
        Route::resource('cuentas', AccountController::class)
            ->except(['create', 'edit', 'show', 'update'])
            ->names('accounts');
        Route::put('desactivar-cuenta/{cuenta}', [AccountController::class, 'deactivate'])->name('accounts.deactivate');
        Route::put('activar-cuenta/{cuenta}', [AccountController::class, 'activate'])->name('accounts.activate');
        Route::get('buscar-cuenta', [AccountController::class, 'searchAccount'])->name('accounts.search');
    });
});