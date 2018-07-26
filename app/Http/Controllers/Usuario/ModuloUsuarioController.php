<?php

namespace App\Http\Controllers\Usuario;

use App\BdModulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuloUsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        $modulos = BdModulo::all();
        return view('usuario.modulos-usuario.index', compact('modulos') );
    }
}
//        $request->user()->authorizeRoles('profe');
// ['modulos' => $modulos];