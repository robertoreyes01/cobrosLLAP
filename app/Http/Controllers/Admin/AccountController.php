<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Support\Str;

/**
 * Class AccountController
 * 
 * Controlador para la gestión de cuentas de usuarios del sistema.
 * Permite crear, leer, actualizar, eliminar y buscar usuarios, incluyendo la gestión
 * de estados de cuenta (activo/inactivo) y generación de contraseñas temporales.
 * Aplica el middleware de autenticación para el guard 'usuario'.
 */
class AccountController extends Controller
{
    /**
     * AccountController constructor.
     * 
     * Aplica el middleware de autenticación para usuarios.
     */
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    /**
     * Muestra la vista de gestión de cuentas con todos los usuarios (excepto administradores).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $accounts = usuario::orderBy('id_rol', 'asc')
            ->select('id_usuario', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'correo', 'estado', 'id_rol')
            ->where('id_rol', '!=', 1)
            ->paginate(9);

        return view('admin.manage_accounts', compact('accounts'));
    }

    /**
     * Genera una contraseña temporal segura de 8 caracteres.
     * Incluye al menos una minúscula, una mayúscula y un número.
     *
     * @return string
     */
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

    /**
     * Almacena un nuevo empleado en el sistema.
     * Genera automáticamente una contraseña temporal y asigna rol de empleado.
     * Envía notificación de verificación por email.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Elimina un usuario del sistema permanentemente.
     *
     * @param usuario $cuenta
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(usuario $cuenta)
    {
        $cuenta->delete();

        ToastMagic::success('Usuario eliminado correctamente');
        return redirect()->route('accounts.index');
    }

    /**
     * Desactiva la cuenta de un usuario (cambia estado a 0).
     *
     * @param usuario $cuenta
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivate(usuario $cuenta)
    {
        $cuenta->update(
            ['estado' => '0']
        );

        ToastMagic::success('Usuario desactivado correctamente');
        return redirect()->route('accounts.index');
    }

    /**
     * Activa la cuenta de un usuario (cambia estado a 1).
     *
     * @param usuario $cuenta
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(usuario $cuenta)
    {
        $cuenta->update(
            ['estado' => '1']
        );

        ToastMagic::success('Usuario activado correctamente');
        return redirect()->route('accounts.index');
    }

    /**
     * Busca usuarios por nombre o apellido.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
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