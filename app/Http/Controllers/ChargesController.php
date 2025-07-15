<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        return view('charges.parents_list', compact('parents'));
    }
    public function searchParents(request $request)
    {
        $request->validate([
            'busqueda' => 'required|string|alpha'
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
}