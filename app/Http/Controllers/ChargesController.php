<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;

class ChargesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:usuario');
    }

    public function parentsList()
    {
        $parents = usuario::where('id_rol', 3)
            ->select('usuario.*')
            ->orderBy('id_usuario', 'desc')
            ->paginate(9);
            // ->get();

        return view('charges.parents_list', compact('parents'));
    }
}
