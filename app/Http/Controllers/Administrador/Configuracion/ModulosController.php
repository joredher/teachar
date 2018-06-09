<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdModulo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
                if ($modulo || $modulo->file_exists(storage_path($modulo->foto))){
                    $modulo->delete();
                    Storage::disk('public')->delete($modulo->foto);
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

            $nombreModulo = preg_replace("/[^a-zA-Z0-9\_\-]+/", "_", $request->nombre);

            if ($request->foto && $request->foto != 'undefined' || $request->foto != null) {
                $imagen = $request->foto;
                $imagen = str_replace('data:image/png;base64,', '', $imagen);
                $imagen = str_replace(' ', '+', $imagen);
                $imageName = str_random(10) . '.' . 'png';
                $uploadImage = 'imagenes_modulos' . '/'.  $nombreModulo .'/'. $imageName;
                Storage::disk('public')->put($uploadImage, base64_decode($imagen));
//                \File::put(storage_path() . '/' . 'app/public/' . '/' . $uploadImage, base64_decode($imagen));
            }

            if ($request->id != ''){
                //update
                $validador = Validator::make($request->all(),
                    [
                        'nombre' => ['required', Rule::unique('bd_modulos')->ignore($request->id)],
                        'descripcion' => 'required|max:250',
                        'slug' => ['required', Rule::unique('bd_modulos')->ignore($request->id)],
                    ]);

                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }
                $modulo = BdModulo::find($request->id);
                $modulo-> nombre = $request->nombre;
                $modulo-> descripcion = $request->descripcion;
                if ($request->foto){
                    $old_filename = '/public/' . $modulo->foto;
                    $modulo->foto = $uploadImage;
                    Storage::disk('local')->delete($old_filename);
                }elseif ($request->foto == $modulo->foto){
                    $modulo->foto = $request->foto;
                }
                $modulo -> estado = $request->estado;
                $modulo -> slug = $request->slug;
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
                    'descripcion' => 'required|max:250',
                    'foto' => 'required',
                    'slug' =>  'required | unique:bd_modulos',
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
                if ($request->foto) {
                    $modulo->foto = $uploadImage;
                }
                $modulo -> estado = $request->estado;
                $modulo -> user_id = Auth::user()->id;
                $modulo -> slug = $request->slug;
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
