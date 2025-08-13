<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    public function index()
    {
        $accounts = usuario::orderBy('id_rol', 'asc')
            ->select('id_usuario', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'correo', 'estado', 'id_rol')
            ->where('id_rol', '!=', 1)
            ->paginate(9);

        return view('admin.manage_accounts', compact('accounts'));
    }

    private function generateTemporaryPassword()
    {
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';

        $password = '';

        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];

        $allChars = $lowercase . $uppercase . $numbers;
        for ($i = 0; $i < 5; $i++)
        {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        return str_shuffle($password);
    }

    public function store(Request $request)
    {
        $request->validate([
            'primer_nombre' => 'required|string|max:20',
            'segundo_nombre' => 'required|string|max:20',
            'primer_apellido' => 'required|string|max:20',
            'segundo_apellido' => 'required|string|max:20',
            'correo' => 'required|email|unique:usuario,correo',
        ]);

        $temporaryPassword = $this->generateTemporaryPassword();

        $usuario = new usuario();
        $usuario->primer_nombre = $request->primer_nombre;
        $usuario->segundo_nombre = $request->segundo_nombre;
        $usuario->primer_apellido = $request->primer_apellido;
        $usuario->segundo_apellido = $request->segundo_apellido;
        $usuario->correo = $request->correo;
        $usuario->password = Hash::make($temporaryPassword);
        $usuario->estado = '1';
        $usuario->id_rol = '2';
        $usuario->save();

        return redirect()->route('accounts.index')
            ->with('success', 'Empleado creado exitosamente. Contraseña temporal: ' . $temporaryPassword);
    }

    public function destroy(usuario $cuenta)
    {
        $cuenta->delete();

        ToastMagic::success('Empleado eliminado correctamente');
        return redirect()->route('accounts.index');
    }

    public function deactivate(usuario $cuenta)
    {
        $cuenta->update(
            ['estado' => '0']
        );

        ToastMagic::success('Empleado desactivado correctamente');
        return redirect()->route('accounts.index');
    }

    public function activate(usuario $cuenta)
    {
        $cuenta->update(
            ['estado' => '1']
        );

        ToastMagic::success('Empleado activado correctamente');
        return redirect()->route('accounts.index');
    }

    public function searchAccount(Request $request)
    {
        $request->validate([
            'busqueda' => 'string|alpha'
        ]);

        $search = Str::ucfirst($request->busqueda);

        $accounts = usuario::where('primer_nombre', 'like', '%' . $search . '%')
            ->orWhere('primer_apellido', 'like', '%' . $search . '%')
            ->select('id_usuario', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'correo', 'estado', 'id_rol')
            ->orderBy('primer_nombre', 'asc')
            ->paginate(9);

        return view('admin.manage_accounts', compact('accounts'));
    }

}