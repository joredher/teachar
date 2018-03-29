<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdModulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

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
                ->orderBy('id','asc')->with(['BdTema'])
                ->paginate(3);
                //dd($modulos);
            return response()->json($modulos);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    public function destroy(Request $request){
        try{
            if ($request->id != ''){
                $id = $request->get('id');
                $modulo = BdModulo::find($id);
//                $fileName = Input::get('imagen');
//                $path = public_path().'/imagenes/modulos/';
                if ($modulo){
                    $modulo->delete();
                    return response()->json([
                        'estado' => 'ok',
                        'id' => $modulo->id,
                        'tipo' => 'delete',
                    ]);
//                    return $data;
                }
                $data['success'] = false;
                return $data;
            }
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    public function guardar(Request $request){
        try{
//            $exploded = array_pad(explode(',', $request->imagen),2,null);
//            $decoded = base64_decode($exploded[1]);
//
//            if(str_contains($exploded[0], 'jpeg'))
//                $extension = 'jpg';
//            else
//                $extension = 'png';
//
//            $fileName = str_random().'.'.$extension;
//            $path = public_path().'/imagenes/modulos/'.$fileName;
//            file_put_contents($path, $decoded);
//            file_put_contents($path, $decoded);

            if ($request->id != ''){
                //update
                $validador = Validator::make($request->all(),
                    [
                        'nombre' => ['required', Rule::unique('bd_modulos')->ignore($request->id)],
                        'descripcion' => 'required|max:300',
//                        'imagen' => 'require|image|max:1024*1024*1'
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
                $modulo-> foto = '';
                if ($request->foto){
                    $modulo->foto = $request->foto;
//                    $modulo->foto = $fileName;
                }
                $modulo -> estado = $request->estado;
//                $modulo -> user_id = Auth::user()->id;
                $modulo -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $modulo ->id,
                    'tipo' => 'update'
                ]);
            }
            else{
                //Create
                $validador = Validator::make($request->all(),[
                    'nombre' =>  'required | unique:bd_modulos',
                    'descripcion' => 'required|max:300',
                    'foto' => 'required'// temporal ampliar cap
//                    'imagen' => 'require|image|max:1024*1024*1'
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
                if($request->foto){
                    $modulo->foto = $request->foto;
//                    $modulo->foto = $fileName;
                }
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

}
