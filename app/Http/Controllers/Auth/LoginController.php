<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\usuario;

class LoginController extends Controller
{
    public function LoginForm()
    {
        // dd(Hash::make('123'));
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $credenciales = $request->only('correo', 'password');

        $usuario = usuario::where('correo', $credenciales['correo'])->first();

        if ($usuario && Hash::check($credenciales['password'], $usuario->password)) {
            Auth::guard('usuario')->login($usuario);
            return redirect()->intended('pagos/principal'); //redirigir a la ruta que se desea
        }

        return back()->withErrors([
            'correo' => 'Credenciales incorrectas',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('usuario')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function signInForm()
    {
        return view('auth.signIn');
    }
}
