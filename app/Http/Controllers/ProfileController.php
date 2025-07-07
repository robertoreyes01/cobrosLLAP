<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use Devrabiul\ToastMagic\Facades\ToastMagic;

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
        return redirect()->route('perfil.show');
    }
}