<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroDocentesController extends Controller
{
    public function vIndex(){
        return view('administrador.configuracion.docentes.form_create_docente');
    }

    public function obtenerDocente(Request $request){
        try{
            $request = json_decode($request->getContent());
            $docentes = User::Buscar($request->datos->busqueda)
                ->orderBy('id','asc')->paginate(20);

            return response()->json($docentes);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
