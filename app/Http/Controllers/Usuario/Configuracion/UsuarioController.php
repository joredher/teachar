<?php

namespace App\Http\Controllers\Usuario\Configuracion;

use App\BdModulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $request->user()->authorizeRoles('profe');
//        return view('usuarios.configuracion.modulos-usuario.index');
    }

    public function getModulos(Request $request){
        $modulos = BdModulo::Buscar($request->datos->busqueda)->orderBy('id', 'asc')->get();
        return $modulos;
    }

}
