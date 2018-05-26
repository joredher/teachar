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

    public function show(Request $request, $id){

        $request->user()->authorizeRoles('profe');
        $modulo = BdModulo::where('id',$id)->with(['BdTema'])->first();
        return view('usuario.temas-usuario.index', ['modulo' => $modulo] );
    }
}
