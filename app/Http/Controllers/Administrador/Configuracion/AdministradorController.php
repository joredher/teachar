<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministradorController extends Controller
{
    public function index(){
        return view('administracion.configuracion.index');
    }
}
