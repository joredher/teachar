<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdObjeto;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class ObjetosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $request->user()->authorizeRoles('admin');
        return view('administracion.configuracion.objetos.index');
    }

     public function obtener(Request $request){
            try{
                $request = json_decode($request->getContent());
                $objetos = BdObjeto::Buscar($request->datos->busqueda)
                    ->orderBy('id','asc')->paginate(3);
                //dd($modulos);
                return response()->json($objetos);

            }catch (\Exception $exception){
                return response()->json($exception);
            }
    }


//    public function guardar(Request $request){
//        try{
////            $exploded = array_pad(explode(',', $request->imagen),2,null);
////            $decoded = base64_decode($exploded[1]);
////
////            if(str_contains($exploded[0], 'jpeg'))
////                $extension = 'jpg';
////            else
////                $extension = 'png';
////
////            $fileName = str_random().'.'.$extension;
////            $path = public_path().'/imagenes/modulos/'.$fileName;
////            file_put_contents($path, $decoded);
////            file_put_contents($path, $decoded);
//
//            $file = $request->file('');
//
//            if ($request->id != ''){
//                //update
//                $validador = Validator::make($request->all(),
//                    [
//                        'nombre' => ['required', Rule::unique('bd_objetos')->ignore($request->id)],
////                        'imagen' => 'require|image|max:1024*1024*1'
//                    ]);
//
//                if ($validador->fails()){
//                    return response()->json([
//                        'estado' => 'validador',
//                        'errors' => $validador->errors()
//                    ]);
//                }
//                $objeto = BdObjeto::find($request->id);
//                $objeto -> nombre = $request->nombre;
//                $objeto -> objeto = $request->objeto;
//                $objeto -> save();
//
//                return response()->json([
//                    'estado' => 'ok',
//                    'id' => $objeto ->id,
//                    'tipo' => 'update'
//                ]);
//            }
//            else{
//                //Create
//                $validador = Validator::make($request->all(),[
//                    'nombre' =>  'required | unique:bd_objetos',
//                ]);
//                if ($validador->fails()){
//                    return response()->json([
//                        'estado' => 'validador',
//                        'errors' => $validador->errors()
//                    ]);
//                }
//                $objeto = new BdObjeto();
//                $objeto -> nombre = $request->nombre;
//                $objeto -> objeto = $request->objeto;
//                $objeto -> save();
//
//                return response()->json([
//                    'estado' => 'ok',
//                    'id' => $objeto-> id,
//                    'tipo' => 'save',
//                ]);
//            }
//        } catch (\Exception $exception){
//            return response()->json([
//                'estado' => 'fail',
//                'error' => $exception->getMessage(),
//            ]);
//        }
//    }
}
