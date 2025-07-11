<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\alumno;
use App\Models\registroPagos;

/**
 * Controlador para la gestión de pagos.
 * Permite mostrar la lista de alumnos asociados al usuario autenticado y el historial de pagos de un alumno.
 */
class PaymentController extends Controller
{
    /**
     * Aplica el middleware de autenticación para el guard 'usuario'.
     */
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    /**
     * Muestra la lista de alumnos asociados al usuario autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function studentList()
    {
        $userId = Auth::user()->id_usuario;

        $alumnos = alumno::join('padre', 'alumno.id_alumno', '=', 'padre.id_alumno')
            ->where('padre.id_usuario', $userId)
            ->select('alumno.*')
            ->get();

        return view('payments.student_list', compact('alumnos'));
    }

    /**
     * Muestra el historial de pagos de un alumno específico.
     *
     * @param  int  $alumno  ID del alumno
     * @return \Illuminate\View\View
     */
    public function paymentRegister($alumno)
    {
        $alumno = alumno::findOrFail($alumno);

        $pagos = registroPagos::where('id_alumno', $alumno->id_alumno)
            ->select('descripcion', 'total', 'fecha', 'lugar')
            ->get();

        return view('payments.register', compact('alumno', 'pagos'));
    }
}
