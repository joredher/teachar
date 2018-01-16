<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdModulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModulosController extends Controller
{
    public function index(){
        return view('administracion.configuracion.modulos.index');

    }

    public function obtener(Request $request){
        try{
            $request = json_decode($request->getContent());
            $modulos = BdModulo::Buscar($request->datos->busqueda)
                ->orderBy('id','desc')
                ->paginate(1);
//dd($modulos);
            return response()->json($modulos);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

   /* public function obtener(Request $request){
        $modulos = BdModulo::all();
        return response()->json($modulos);
        //return $modulos;
    }*/


}
