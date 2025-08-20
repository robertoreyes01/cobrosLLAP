<?php

/**
 * Archivo de Rutas Web - Sistema de Gestión de Pagos y Cobros LLAP
 * 
 * Este archivo define todas las rutas web de la aplicación, organizadas por funcionalidad
 * y nivel de acceso según el rol del usuario autenticado.
 * 
 * Estructura de Rutas:
 * 
 * 1. Rutas Públicas (Sin Autenticación):
 *    - Login y registro de usuarios
 *    - Verificación de email
 *    - Recuperación de contraseña
 * 
 * 2. Rutas Protegidas (Con Autenticación):
 *    - Menú principal y perfil de usuario
 *    - Gestión de pagos (roles 1,2,3)
 *    - Gestión de cobros y estudiantes (roles 1,2)
 *    - Gestión administrativa completa (rol 1)
 * 
 * Middleware Utilizados:
 * - auth:usuario: Verifica autenticación con guard personalizado
 * - verified: Requiere verificación de email
 * - check.user.type: Verifica rol específico del usuario
 * - guest: Solo para usuarios no autenticados
 * - signed: Verifica firma de URL para verificación
 * - throttle: Limita intentos de envío de emails
 * 
 * Controladores Utilizados:
 * - LoginController: Autenticación y registro
 * - MainController: Vista principal
 * - ProfileController: Gestión de perfil
 * - PaymentController: Gestión de pagos
 * - ChargesController: Gestión de cobros
 * - StudentController: Gestión de estudiantes
 * - PriceController: Gestión de precios
 * - AccountController: Gestión de cuentas
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Payments\PaymentController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Charges\ChargesController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\AccountController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', [LoginController::class, 'LoginForm'])->name('loginForm');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('signIn', [LoginController::class, 'signInForm'])->name('signInForm');
Route::post('signIn', [LoginController::class, 'signIn'])->name('signIn');

// Rutas de verificación de email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:usuario')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/menu-principal');
})->middleware(['auth:usuario', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Se ha enviado un nuevo enlace de verificación a tu correo electrónico.');
})->middleware(['auth:usuario', 'throttle:6,1'])->name('verification.resend');

// Rutas de recuperación de contraseña
Route::get('/olvidar-contrasena', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
 
Route::post('/olvidar-contrasena', function (Request $request) {
    $request->validate(['correo' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('correo')
    );
 
    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['correo' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/restablecer-contrasena/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/restablecer-contrasena', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'correo' => 'required|email',
        'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s)(?!.*[\x{1F600}-\x{1F64F}])(?!.*[\x{1F300}-\x{1F5FF}])(?!.*[\x{1F680}-\x{1F6FF}])(?!.*[\x{1F1E0}-\x{1F1FF}])(?!.*[\x{2600}-\x{26FF}])(?!.*[\x{2700}-\x{27BF}])/u'
            ],
    ], [
        'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y no puede contener espacios o emojis.'
    ]);
 
    $status = Password::reset(
        $request->only('correo', 'password', 'password_confirmation', 'token'),
        function (usuario $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PasswordReset
        ? redirect()->route('loginForm')->with('status', __($status))
        : back()->withErrors(['correo' => [__($status)]]);
})->middleware('guest')->name('password.update');

// Rutas protegidas por autenticación y verificación de email
Route::middleware(['auth:usuario', 'verified'])->group(function(){
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
        Route::post('asignar-padre', [StudentController::class, 'assignParent'])->name('assign.parent');
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