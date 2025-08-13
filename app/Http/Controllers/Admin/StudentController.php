<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\alumno;
use Illuminate\Support\Str;
use Devrabiul\ToastMagic\Facades\ToastMagic;

/**
 * Class StudentController
 * 
 * Controlador para la gestión de estudiantes del sistema educativo.
 * Permite crear, leer, actualizar, eliminar y buscar estudiantes, incluyendo su información de sección.
 * Aplica el middleware de autenticación para el guard 'usuario'.
 */
class StudentController extends Controller
{
    /**
     * StudentController constructor.
     * 
     * Aplica el middleware de autenticación para usuarios.
     */
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    /**
     * Muestra la vista de gestión de estudiantes con paginación.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $students = alumno::join('seccion', 'alumno.id_seccion', '=', 'seccion.id_seccion')
            ->select('alumno.*', 'seccion.nombre as seccion')
            ->orderBy('id_alumno', 'desc')
            ->paginate(9);

        return view('admin.manage_students', compact('students'));
    }

    /**
     * Busca estudiantes por nombre o apellido.
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

        $students = alumno::join('seccion', 'alumno.id_seccion', '=', 'seccion.id_seccion')
            ->where('alumno.nombres', 'like', '%' . $search . '%')
            ->orWhere('alumno.apellidos', 'like', '%' . $search . '%')
            ->select('alumno.*', 'seccion.nombre as seccion')
            ->orderBy('id_alumno', 'desc')
            ->paginate(9);

        return view('admin.manage_students', compact('students'));
    }

    /**
     * Almacena un nuevo estudiante en el sistema.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|ascii',
            'apellidos' => 'required|string|ascii',
            'sección' => 'required'
        ]);

        $student = new alumno();
        $student->nombres = $request->nombres;
        $student->apellidos = $request->apellidos;
        $student->id_seccion = $request->sección;
        $student->save();

        ToastMagic::success('Estudiante agregado correctamente');
        return redirect()->route('students.index');
    }

    /**
     * Actualiza la información de un estudiante existente.
     *
     * @param Request $request
     * @param alumno $estudiante
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, alumno $estudiante)
    {
        $request->validate([
            'nombres' => 'required|string|ascii',
            'apellidos' => 'required|string|ascii',
            'sección' => 'required'
        ]);

        $estudiante->update(
            [
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'id_seccion' => $request->sección
            ]
        );

        ToastMagic::success('Estudiante actualizado correctamente');
        return redirect()->route('students.index');
    }

    /**
     * Elimina un estudiante del sistema.
     *
     * @param alumno $estudiante
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(alumno $estudiante)
    {
        $estudiante->delete();

        ToastMagic::success('Estudiante eliminado correctamente');
        return redirect()->route('students.index');
    }
}