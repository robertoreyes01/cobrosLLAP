<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\seccion;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

/**
 * Class PriceController
 * 
 * Controlador para la gestión de precios y secciones del sistema educativo.
 * Permite crear, leer, actualizar y eliminar secciones con sus respectivos precios de matrícula y mensualidad.
 * Aplica el middleware de autenticación para el guard 'usuario'.
 */
class PriceController extends Controller
{
    /**
     * PriceController constructor.
     * 
     * Aplica el middleware de autenticación para usuarios.
     */
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    /**
     * Muestra la vista de gestión de precios con todas las secciones.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $prices = seccion::all();

        return view('admin.manage_price', compact('prices'));
    }

    /**
     * Almacena una nueva sección con sus precios.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'matricula' => 'required|numeric',
            'mensualidad' => 'required|numeric',
        ]);

        $price = new seccion();
        $price->nombre = $request->nombre;
        $price->matricula = $request->matricula;
        $price->mensualidad = $request->mensualidad;
        $price->save();

        ToastMagic::success('Sección agregada correctamente');
        return redirect()->route('prices.index');
    }

    /**
     * Actualiza una sección existente con nuevos datos.
     *
     * @param Request $request
     * @param seccion $precio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, seccion $precio)
    {
        $request->validate([
            'nombre' => 'required|string',
            'matricula' => 'required|numeric',
            'mensualidad' => 'required|numeric',
        ]);

        $precio->update($request->all());

        ToastMagic::success('Sección actualizada correctamente');
        return redirect()->route('prices.index');
    }

    /**
     * Elimina una sección del sistema.
     *
     * @param seccion $precio
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(seccion $precio)
    {
        $precio->delete();

        ToastMagic::success('Sección eliminada correctamente');
        return redirect()->route('prices.index');
    }
}
