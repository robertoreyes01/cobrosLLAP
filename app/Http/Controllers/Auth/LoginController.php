<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\usuario;
use App\Models\padre;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function LoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|exists:usuario,correo',
            'password' => 'required',
        ]);

        $credenciales = $request->only('correo', 'password');

        $usuario = usuario::where('correo', $credenciales['correo'])->first();

        if ($usuario && Hash::check($credenciales['password'], $usuario->password)) {
            Auth::login($usuario);
            
            // Verificar si el login fue exitoso
            if (Auth::check() && $usuario->estado == '1') {
                $request->session()->regenerate();
                return redirect()->intended(route('main'));
            } else {
                Auth::logout();
                return redirect()->route('loginForm')->with('error', 'Tu cuenta ha sido desactivada');
            }
        }

        throw ValidationException::withMessages([
            $credenciales['correo'] => 'Credenciales incorrectas',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginForm');
    }

    public function signInForm()
    {
        return view('auth.signIn');
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'primer_nombre' => 'required|string',
            'segundo_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'segundo_apellido' => 'required|string',
            'correo' => 'required|email|unique:usuario,correo',
            'contrasena' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s)(?!.*[\x{1F600}-\x{1F64F}])(?!.*[\x{1F300}-\x{1F5FF}])(?!.*[\x{1F680}-\x{1F6FF}])(?!.*[\x{1F1E0}-\x{1F1FF}])(?!.*[\x{2600}-\x{26FF}])(?!.*[\x{2700}-\x{27BF}])/u'
            ],
        ], [
            'contrasena.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y no puede contener espacios o emojis.'
        ]);

        $usuario = new usuario();
        $usuario->primer_nombre = $request->primer_nombre;
        $usuario->segundo_nombre = $request->segundo_nombre;
        $usuario->primer_apellido = $request->primer_apellido;
        $usuario->segundo_apellido = $request->segundo_apellido;
        $usuario->correo = $request->correo;
        $usuario->password = Hash::make($request->contrasena);
        $usuario->estado = '1';
        $usuario->id_rol = '3';
        $usuario->save();

        $padre = new padre();
        $padre->id_usuario = $usuario->id_usuario;
        $padre->save();

        $usuario->sendEmailVerificationNotification();

        ToastMagic::info('Por favor revisa tu correo');
        return redirect()->route('loginForm');
    }
}