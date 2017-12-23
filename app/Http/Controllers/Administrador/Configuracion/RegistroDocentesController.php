<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroDocentesController extends Controller
{
    public function vIndex(){
        return view('administrador.configuracion.docentes.form_create_docente');
    }

    public function obtenerDocente(Request $request){
        try{

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
