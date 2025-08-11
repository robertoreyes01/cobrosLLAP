<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\seccion;
use Illuminate\Http\Request;
use Devrabiul\ToastMagic\Facades\ToastMagic;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    public function index()
    {
        $prices = seccion::all();

        return view('admin.manage_price', compact('prices'));
    }

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

    public function destroy(seccion $precio)
    {
        $precio->delete();

        ToastMagic::success('Sección eliminada correctamente');
        return redirect()->route('prices.index');
    }
}
