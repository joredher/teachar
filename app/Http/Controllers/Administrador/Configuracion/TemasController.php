<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdModulo;
use App\BdObjeto;
use App\BdTema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TemasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $request->user()->authorizeRoles('admin');
        return view('administracion.configuracion.temas.index');
    }

    public function obtenerTemas(Request $request){
        try{
            $request = json_decode($request->getContent());
            $temas = BdTema::Buscar($request->datos->busqueda)->with(['BdModulo', 'BdObjeto'])
                ->orderBy('id','asc')
                ->paginate(3);
            //dd($modulos);
            return response()->json($temas);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    public function obtenerComplemento(){
        try{
            return response()->json([
                'modulos' => BdModulo::all(),
                'objetos' => BdObjeto::all()
            ]);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    public function destroy(Request $request){
        try{
            if ($request->id != ''){
                $id = $request->get('id');
                $tema = BdTema::find($id);

                if ($tema){
                    $tema->delete();
                    return response()->json([
                        'estado' => 'ok',
                        'id' => $tema->id,
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

    function id_youtube($url) {
        $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
        $array = preg_match($patron, $url, $parte);
        if (false !== $array) {
            return $parte[1];
        }
        return false;
    }

    public function guardar(Request $request){
        try{
            if ($request->id != ''){
                //update
                $validador = Validator::make($request->all(),
                    [
                        'nombre' => ['required', Rule::unique('bd_temas')->ignore($request->id)],
                        'contenido' => 'required|max:250',
                    ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $tema = BdTema::find($request->id);
                $tema -> nombre = $request->nombre;
                $tema -> contenido = $request->contenido;
                $tema -> video_url = $this->id_youtube($request->video_url);
                $tema -> estado = $request->estado;
                $tema -> modulo_id = $request->modulo_id;
                $tema -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $tema ->id,
                    'tipo' => 'update'
                ]);

            }else{
                //Create
                $validador = Validator::make($request->all(),[
                    'nombre' =>  'required | unique:bd_temas',
                    'contenido' => 'required|max:250',
                ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $tema = new BdTema();
                $tema -> nombre = $request->nombre;
                $tema -> contenido = $request->contenido;
                $tema -> video_url = $this->id_youtube($request->video_url);
                $tema -> estado = $request->estado;
                $tema -> modulo_id = $request->modulo_id;
                $tema -> save();


                return response()->json([
                    'estado' => 'ok',
                    'id' => $tema-> id,
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
