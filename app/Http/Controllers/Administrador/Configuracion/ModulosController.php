<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdModulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class ModulosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $request->user()->authorizeRoles('admin');
        return view('administracion.configuracion.modulos.index');
    }

    public function obtener(Request $request){
        try{
            $request = json_decode($request->getContent());
            $modulos = BdModulo::Buscar($request->datos->busqueda)
                ->orderBy('id','asc')
                ->paginate(4);
                //dd($modulos);
            return response()->json($modulos);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }


    public function guardar(Request $request){
        try{
            if ($request->id != ''){
                //update
                $validador = Validator::make($request->all(),
                    [

                        'nombre' => ['required', Rule::unique('bd_modulos')->ignore($request->id)],
                        'descripcion' => 'required|max:150',
                        'estado' => 'required'
                    ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $modulo = BdModulo::find($request->id);
                $modulo -> nombre = $request->nombre;
                $modulo -> descripcion = $request->descripcion;
                $modulo -> estado = $request->estado;
                $modulo -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $modulo ->id,
                    'tipo' => 'update'
                ]);

            }else{
                //Create
                $validador = Validator::make($request->all(),[
                    'nombre' =>  'required | unique:bd_modulos',
                    'descripcion' => 'required|max:150',  // temporal ampliar cap
                    'estado' => 'required'
                ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $modulo = new BdModulo();
                $modulo -> nombre = $request->nombre;
                $modulo -> descripcion = $request->descripcion;
                $modulo -> imagen = $request->estado;
                $modulo -> estado = $request->estado;
                $modulo -> user_id = Auth::user()->id;
                $modulo -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $modulo-> id,
                    'tipo' => 'save',
                ]);
            }
        } catch (\Exception $exception){
            return response()->json([
                'estado' => 'fail',
                'error' => $exception->getMessage(),
            ]);
        }
    }



   /* public function obtener(Request $request){
        $modulos = BdModulo::all();
        return response()->json($modulos);
        //return $modulos;
    }*/


}
