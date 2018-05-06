<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdObjeto;
use App\BdTema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ObjetosController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $request->user()->authorizeRoles('admin');

//        $objetos = BdObjeto::orderBy('created_at', 'desc')->get();
//        return view('administracion.configuracion.objetos.index', compact('objetos'));
        return view('administracion.configuracion.objetos.index');
    }

    public function obtenerObjetos(Request $request){
        try{
            $request = json_decode($request->getContent());
            $objetos = BdObjeto::Buscar($request->datos->busqueda)->with('BdTema')
                ->orderBy('id','asc')
                ->paginate(3);
            return response()->json($objetos);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    public function obtenerComplemento(){
        try{
            return response()->json([
                'temas' => BdTema::all()
            ]);
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    public function destroy(Request $request){
        try{
            if ($request->id != ''){
                $id = $request->get('id');
                $objeto = BdObjeto::find($id);

                if ($objeto || $objeto->file_exists( storage_path($objeto->modelo)) && $objeto->file_exists( storage_path($objeto->material)))
                {
                    $objeto->delete();
                    Storage::delete([$objeto->modelo, $objeto->material]);
                    return response()->json([
                        'estado' => 'ok',
                        'id' => $objeto->id,
                        'tipo' => 'delete',
                    ]);
                }
//                    return $data;
                $data['success'] = false;
                return $data;
            }
        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }

    private function getDir($id){
//        $temas = BdTema::all();
        $temas = BdTema::where('id', '=' ,$id)->get();
        foreach ($temas as $tema){
            return $tema->nombre;
        }
    }

    public function guardar(Request $request){
        try{

            if ($request->hasFile('file')){
                $objetos = $request->file('file');

                foreach ($objetos as $objeto){
                    $originalFileName = $objeto->getClientOriginalName();
                    $extension = $objeto->getClientOriginalExtension();

                    if ($extension == 'mtl') {
                        $materialNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                        $materialName = str_slug($materialNameOnly) . "." . $extension;
                        $uploadedMaterialName = $objeto->storeAs('public', $this->getDir($request->get('tema')) . '/' . $materialName);
//                        if ($objeto->move($uploadedMaterialName, $materialName)){
//                            return $materialName;
//                        }
//                        $uploadedMaterialName = $objeto->storeAs('public', $this->getDir($request->get('tema')) . '/' . $materialName);
//                        $uploadedMaterialName = $objeto->storeAs('public', $request->get('tema') . "/" . $materialName);
//                        return [$uploadedFileName, $materialNameOnly];
                    }
                    if ($extension == 'obj') {
                        $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                        $fileName = str_slug($fileNameOnly) . "." . $extension;
                        $uploadedFileName = $objeto->storeAs('public', $this->getDir($request->get('tema')) . '/' . $fileName);
//                        if ($objeto->move($uploadedFileName, $fileName)){
//                            return $fileName;
//                        }
//                        $uploadedFileName = $objeto->storeAs('public', $this->getDir($request->get('tema')) . '/' . $fileName );
//                        Storage::putFileAs('/public/' . $request->get('tema') . '/' . $fileName);

//                        $uploadedFileName = $objeto->storeAs('public', $request->get('tema') . "/" . $fileName);
//                        return [$uploadedFileName, $fileNameOnly];
                    }
                }

            }

            if (Input::get('titulo')){
                $titulo = $request->input('titulo');
            }

            if ($request->get('tema')){
                $tema = $request->get('tema');
            }

            if ($request->id != ''){
                //update
                $validador = Validator::make($request->all(),
                    [
                        'titulo' => ['required', Rule::unique('bd_objetos')->ignore($request->id)],
                        'file' => 'required',
                        'tema' => 'required',
                    ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $objeto = BdObjeto::find($request->id);
                $objeto -> titulo  = $request->titulo;
                $objeto -> nombre_modelo = $fileNameOnly;
                $objeto -> modelo = $uploadedFileName;
                $objeto -> nombre_material = $materialNameOnly;
                $objeto -> material = $uploadedMaterialName;
                $objeto -> tema_id  = $request->tema_id;
                $objeto -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $objeto ->id,
                    'tipo' => 'update',
                    'objetos' => BdObjeto::whereId($objeto->id)->with([
                        'BdTema'
                    ])->get(),
                ]);

            }else{
                //Create
                $validador = Validator::make($request->all(),[
                    'titulo' => 'required|unique:bd_objetos',
                    'file' => 'required',
                    'tema' => 'required',
                ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $objeto = new BdObjeto();
                $objeto -> titulo  = $titulo;
                $objeto -> nombre_modelo = $fileNameOnly;
                $objeto -> modelo = $fileName;
                $objeto -> nombre_material = $materialNameOnly;
                $objeto -> material = $materialName;
                $objeto -> tema_id  = $tema;
                $objeto -> save();


                return response()->json([
                    'estado' => 'ok',
                    'id' => $objeto-> id,
                    'tipo' => 'save',
                    'objetos' => BdObjeto::whereId($objeto->id)->with([
                        'BdTema'
                    ])->get(),
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
