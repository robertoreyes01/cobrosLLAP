<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Facades\Hash;
use App\Models\padre;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    public function show()
    {
        return view('profile.show');
    }

    public function update(Request $request, usuario $usuario){
        $request->validate([
            'primer_nombre' => 'required|string',
            'segundo_nombre' => 'required|string',
            'primer_apellido' => 'required|string',
            'segundo_apellido' => 'required|string',
        ]);

        $usuario->update($request->all());
        
        ToastMagic::success('Perfil actualizado correctamente');
        return redirect()->route('profile.show');
    }

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

    public function changePassword(Request $request, usuario $usuario){
        $request->validate([
            'nueva_contraseña' => [
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

    public function delete(Request $request, usuario $usuario){

        $padre = padre::where('id_usuario', $usuario->id_usuario)->first();
        if($padre){
            $padre->delete();
        }
        
        $usuario->delete();
        return redirect()->route('loginForm');
    }
}