<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocentesController extends Controller
{
    public function vIndex(){
        return view('administracion.configuracion.docentes.index');
    }

    public function obtener(Request $request){
        try{
            $request = json_decode($request->getContent());
            $docentes = User::Buscar($request->datos->busqueda)
                ->orderBy('id','desc')
                ->paginate(1);

            return response()->json($docentes);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
