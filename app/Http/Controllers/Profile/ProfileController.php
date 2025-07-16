<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\usuario;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Hash;

/**
 * Controlador para la gestión del perfil de usuario.
 * Permite mostrar, actualizar datos, cambiar correo y contraseña del usuario autenticado.
 */
class ProfileController extends Controller
{
    /**
     * Aplica el middleware de autenticación para el guard 'usuario'.
     */
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    /**
     * Muestra la vista del perfil del usuario.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('profile.show');
    }

    /**
     * Actualiza los datos básicos del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, usuario $usuario){
        $request->validate([
            'primer_nombre' => 'required|string|alpha',
            'segundo_nombre' => 'required|string|alpha',
            'primer_apellido' => 'required|string|alpha',
            'segundo_apellido' => 'required|string|alpha',
        ]);

        $usuario->update($request->all());
        
        ToastMagic::success('Perfil actualizado correctamente');
        return redirect()->route('profile.show');
    }

    /**
     * Cambia el correo electrónico del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeEmail(Request $request, usuario $usuario){
        $request->validate([
            'nuevo_correo' => 'required|email|unique:usuario,correo',
        ]);

        $usuario->update([
            'correo' => $request->nuevo_correo,
        ]);

        ToastMagic::success('Correo actualizado correctamente');
        return redirect()->route('profile.show');
    }

    /**
     * Cambia la contraseña del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\usuario  $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request, usuario $usuario){
        $request->validate([
            'nueva_contraseña' => [
                'unique:usuario,password',
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s)(?!.*[\x{1F600}-\x{1F64F}])(?!.*[\x{1F300}-\x{1F5FF}])(?!.*[\x{1F680}-\x{1F6FF}])(?!.*[\x{1F1E0}-\x{1F1FF}])(?!.*[\x{2600}-\x{26FF}])(?!.*[\x{2700}-\x{27BF}])/u'
            ],
        ],[
            'nueva_contraseña.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y no puede contener espacios o emojis.'
        ]);

        $usuario->update([
            'password' => Hash::make($request->nueva_contraseña),
        ]);

        ToastMagic::success('Contraseña actualizada correctamente');
        return redirect()->route('profile.show');
    }
}