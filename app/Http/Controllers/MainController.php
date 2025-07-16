<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class MainController
 * 
 * Controlador principal encargado de manejar la vista principal de la aplicación.
 * Aplica el middleware de autenticación para el guard 'usuario'.
 */
class MainController extends Controller
{
    /**
     * MainController constructor.
     * 
     * Aplica el middleware de autenticación para usuarios.
     */
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    /**
     * Muestra la vista principal de la aplicación.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('main');
    }
}