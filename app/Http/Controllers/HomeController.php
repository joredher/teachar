<?php

namespace App\Http\Controllers;

use App\BdModulo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','profe']);

        if ($request->user()->hasRole('profe')){
            $modulos = BdModulo::all();
            return view('usuarios.configuracion.modulos-usuario.index', ['modulos'=>$modulos]);
//            return view('usuarios.configuracion.index');
        }
        if($request->user()->hasRole('admin')){
            return view('administracion.configuracion.index');
        }

//        if($request->user()->hasRole('profe')){
//            return view('docente.configuracion.index');
//        }
//        if($request->user()->hasRole('admin')){
//            return view('administrador.configuracion.index');
//        }

//        return view('home');
//        $request->user()->authorizeRoles(['admin']);
//        return view('administracion.configuracion.index');
    }
}
