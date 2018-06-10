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
        $request->user()->authorizeRoles('profe');
        $modulos = BdModulo::all();
        return view('usuario.modulos-usuario.index', ['modulos' => $modulos]);
    }
}
