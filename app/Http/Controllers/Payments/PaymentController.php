<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\alumno;
use App\Models\registroPagos;
use App\Models\usuario;
use App\Models\seccion;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Http\Request;

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
     * Muestra la lista de alumnos asociados al padre o tutor encargado.
     *
     * @return \Illuminate\View\View
     */
    public function studentList($padre)
    {
        $alumnos = alumno::join('padre', 'alumno.id_alumno', '=', 'padre.id_alumno')
            ->where('padre.id_usuario', $padre)
            ->select('alumno.*')
            ->get();

        $padre = usuario::findOrFail($padre);

        return view('payments.student_list', compact('alumnos', 'padre'));
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

        $alumno_nombre = explode(' ', trim($alumno->nombres))[0];
        $alumno_apellido = explode(' ', trim($alumno->apellidos))[0];

        $seccion = seccion::where('id_seccion', $alumno->id_seccion)->first();

        $pagos = registroPagos::where('id_alumno', $alumno->id_alumno)
            ->select('registro_pagos.*')
            ->get();

        $months = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ];

        if ($alumno->id_seccion != 1) {
            array_pop($months);
        }

        $payentsMonthly = registroPagos::where('id_alumno', $alumno->id_alumno)
            ->where('descripcion', 'like', 'Mensualidad%')
            ->orderBy('fecha', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return \Carbon\Carbon::parse($item->fecha)->year;
            });

        $actualYear = now()->year;
        $mes = null;

        foreach ($payentsMonthly as $year => $pagos) {
            $monthsPaid = $pagos->pluck('descripcion')->map(function ($desc) {
                return trim(explode(' ', $desc)[1]);
            })->toArray();

            $missing = array_diff($months, $monthsPaid);

            if (count($missing) > 0) {
                $actualYear = $year;
                $mes = reset($missing);
                break;
            }
        }

        if ($mes === null) {
            $actualYear = $actualYear + 1;
            $mes = $months[0];
        }

        return view('payments.register', compact('pagos', 'alumno', 'alumno_nombre', 'alumno_apellido', 'seccion', 'mes'));
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string',
            'total' => 'required|numeric|min:0',
            'fecha' => 'required|date',
            'lugar' => 'required|string',
        ]);

        $pago = new registroPagos();
        $pago->id_alumno = $request->id_alumno;
        $pago->descripcion = $request->descripcion;
        $pago->total = $request->total;
        $pago->fecha = $request->fecha;
        $pago->lugar = $request->lugar;
        $pago->save();

        ToastMagic::success('Pago registrado correctamente');
        return redirect()->back();
    }

    public function updatePayment(Request $request, registroPagos $pago){
        $request->validate([
            'fecha' => 'required|date',
            'lugar' => 'required|string',
        ]);

        $pago->update($request->all());
        
        ToastMagic::success('Pago actualizado correctamente');
        return redirect()->back();
    }

    public function destroyPayment(registroPagos $pago)
    {
        $pago->delete();

        ToastMagic::success('Pago eliminado correctamente');
        return redirect()->back();
    }
}
