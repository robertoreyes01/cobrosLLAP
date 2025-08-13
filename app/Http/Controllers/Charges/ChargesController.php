<?php

namespace App\Http\Controllers\Charges;

use App\Http\Controllers\Controller;
use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\alumno;

/**
 * Class ChargesController
 * 
 * Controlador para la gestión de listas de padres/tutores y estudiantes en el módulo de cobros.
 * Permite buscar y mostrar listas paginadas de padres/tutores y estudiantes para facilitar el proceso de cobros.
 * Aplica el middleware de autenticación para el guard 'usuario'.
 */
class ChargesController extends Controller
{
    /**
     * ChargesController constructor.
     * 
     * Aplica el middleware de autenticación para usuarios.
     */
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    /**
     * Muestra la lista de padres/tutores con paginación.
     * Filtra usuarios con rol 3 (padres/tutores).
     *
     * @return \Illuminate\View\View
     */
    public function parentsList()
    {
        $parents = usuario::where('id_rol', 3)
            ->select('usuario.*')
            ->orderBy('id_usuario', 'desc')
            ->paginate(9);

        return view('charges.parents_list', compact('parents'));
    }

    /**
     * Busca padres/tutores por nombre o apellido.
     * Filtra usuarios con rol 3 y aplica búsqueda en primer_nombre y primer_apellido.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function searchParents(request $request)
    {
        $request->validate([
            'busqueda' => 'string|alpha'
        ]);

        $search = Str::ucfirst($request->busqueda);

        $parents = usuario::where('id_rol', 3)
            ->where(function($query) use ($search){
                $query->where('primer_nombre', 'like', '%' . $search . '%')
                ->orWhere('primer_apellido', 'like', '%' . $search . '%');
            })
            ->select('usuario.*')
            ->orderBy('primer_nombre', 'asc')
            ->paginate(9);

        return view('charges.parents_list', compact('parents'));
    }

    /**
     * Muestra la lista de estudiantes con paginación.
     * Incluye nombres, apellidos e ID de los estudiantes.
     *
     * @return \Illuminate\View\View
     */
    public function studentsList()
    {
        $alumnos = alumno::select('nombres', 'apellidos', 'id_alumno')
            ->orderBy('nombres', 'asc')
            ->paginate(9);

        return view('charges.students_list', compact('alumnos'));
    }

    /**
     * Busca estudiantes por nombre o apellido.
     * Aplica búsqueda en los campos nombres y apellidos.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function searchStudent(Request $request)
    {
        $request->validate([
            'busqueda' => 'string|alpha'
        ]);

        $search = Str::ucfirst($request->busqueda);

        $alumnos = alumno::where('nombres', 'like', '%' . $search . '%')
            ->orWhere('apellidos', 'like', '%' . $search . '%')
            ->select('alumno.*')
            ->orderBy('nombres', 'asc')
            ->paginate(9);

        return view('charges.students_list', compact('alumnos'));
    }

}