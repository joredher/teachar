<?php

namespace App\Http\Controllers;

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
//        $request->user()->authorizeRoles(['admin','profe']);

//        if ($request->user()->hasRole('profe')){
//            return view('docente.configuracion.index');
//        }
//        if($request->user()->hasRole('admin')){
//            return view('administrador.configuracion.dashboard');
//        }

//        if($request->user()->hasRole('profe')){
//            return view('docente.configuracion.index');
//        }
//        if($request->user()->hasRole('admin')){
//            return view('administrador.configuracion.index');
//        }

//        return view('home');
//        $request->user()->authorizeRoles(['admin']);
        return view('administracion.configuracion.index');
    }
}
