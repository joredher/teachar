<?php

namespace App\Http\Controllers\Usuario;


use App\BdModulo;
use App\BdObjeto;
use App\BdTema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AumentadaUsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, $id){
        $request->user()->authorizeRoles('profe');

        $tema = BdTema::where('id', $id)->with(['BdObjeto'])->first();
        return view('usuario.aumentadas-usuario.index_ra', ['tema' => $tema]);
    }
}
