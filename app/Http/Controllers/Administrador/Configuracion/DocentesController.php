<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocentesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vIndex(Request $request){
        $request->user()->authorizeRoles('admin');
        return view('administracion.configuracion.docentes.index');
    }

    public function obtener(Request $request){
        try{
            $request = json_decode($request->getContent());
            $docentes = User::Buscar($request->datos->busqueda)->with('roles')
                ->orderBy('id','desc')
                ->paginate(4);

            return response()->json($docentes);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }
}
