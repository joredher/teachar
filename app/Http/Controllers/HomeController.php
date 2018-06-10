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
        $this->middleware('step');
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
            return view('usuario.index');
        }
        if($request->user()->hasRole('admin')){
            return view('administracion.configuracion.index');
        }
//            $modulos = BdModulo::all();
//            return view('usuario.modulos-usuario.index', ['modulos'=>$modulos]);
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
