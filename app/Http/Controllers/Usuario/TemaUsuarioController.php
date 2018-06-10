<?php

namespace App\Http\Controllers\Usuario;

use App\BdModulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemaUsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, $slug){

        $request->user()->authorizeRoles('profe');
        $modulo = BdModulo::where('slug', '=', $slug)->with(['BdTema'])->firstOrFail();
        return view('usuario.temas-usuario.index', ['modulo' => $modulo], compact('modulo') );
    }
}
