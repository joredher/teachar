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

    public function index(Request $request)
    {
        $request->user()->authorizeRoles('admin');

//        $objetos = BdObjeto::orderBy('created_at', 'desc')->get();
//        return view('administracion.configuracion.objetos.index', compact('objetos'));
        return view('administracion.configuracion.objetos.index');
    }

    public function obtenerObjetos(Request $request)
    {
        try {
            $request = json_decode($request->getContent());
            $objetos = BdObjeto::Buscar($request->datos->busqueda)->with('BdTema')
                ->orderBy('id', 'asc')
                ->paginate(3);
            return response()->json($objetos);
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function obtenerComplemento()
    {
        try {
            return response()->json([
                'temas' => BdTema::all()
            ]);
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    public function destroy(Request $request)
    {
        try {
            if ($request->id != '') {
                $id = $request->get('id');
                $objeto = BdObjeto::find($id);
//                if ($objeto || $objeto->file_exists( storage_path($objeto->modelo)) && $objeto->file_exists( storage_path($objeto->material)))
                if ($objeto || $objeto->file_exists(storage_path($objeto->src)) && $objeto->file_exists(storage_path($objeto->material))) {
                    $objeto->delete();
                    Storage::disk('public')->delete([$objeto->src, $objeto->material]);
//                    Storage::disk('public')->delete([$objeto->modelo, $objeto->material]);
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
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    private function getDir($id)
    {
//        $temas = BdTema::all();
        $temas = BdTema::where('id', '=', $id)->get();
        foreach ($temas as $tema) {
            $nombre = preg_replace("/[^a-zA-Z0-9\_\-]+/", "_", $tema->nombre);
//            return $tema->nombre;
            return $nombre;
        }
    }

    public function guardar(Request $request)
    {
        try {
            if (Input::get('titulo')) {
                $titulo = $request->input('titulo');
                $titleName = preg_replace("/[^a-zA-Z0-9\_\-]+/", "_", $titulo);
            }

            if ($request->get('tema')) {
                $tema = $request->get('tema');
            }

            if ($request->hasFile('file')){
                $objetos = $request->file('file');

                foreach ($objetos as $objeto) {
                    $originalFileName = $objeto->getClientOriginalName();
                    $extension = $objeto->getClientOriginalExtension();
                    $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
//                    dd($extension);
                    switch ($extension) {
                        case ('gltf'):
                            $fileName = str_slug($fileNameOnly) . "." . $extension;
                            $uploadedFileName = $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $fileName;
                            $objeto->storeAs('public', $uploadedFileName);
                            break;
                        case ('dae') :
                            $fileName = str_slug($fileNameOnly) . "." . $extension;
                            $uploadedFileName = $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $fileName;
                            $objeto->storeAs('public', $uploadedFileName);
                            break;
                        case ('obj') :
                            if ($extension == 'obj'){
                                $fileName = str_slug($fileNameOnly) . "." . $extension;
                                $uploadedFileName = $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $fileName;
                                $objeto->storeAs('public', $uploadedFileName);
                            }
                            break;
                        case ('mtl'):
                            $materialNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                            $materialName = str_slug($materialNameOnly) . "." . $extension;
                            $uploadedMaterialName = $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $materialName;
                            $objeto->storeAs('public', $uploadedMaterialName);
                            break;
                        default:
                            $imageName = str_slug($fileNameOnly) . "." . $extension;
                            $uploadedImageName = $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $imageName;
                            $objeto->storeAs('public', $uploadedImageName);
//
                    }
                }
            }
            if ($request->id != '') {
                //update
                $validador = Validator::make($request->all(),
                    [
//                        'titulo' => ['required', Rule::unique('bd_objetos')->ignore($request->id)],
                        'file' => 'required',
                        'tema' => 'required',
                    ]);
                if ($validador->fails()) {
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $objeto = BdObjeto::find($request->id);
                $old_filename = storage_path($objeto->src);
                $new_filename = $uploadedFileName;
                if (Storage::disk('public')->file_exists([$old_filename])) {
                    if (Storage::disk('public')->move([$old_filename, $new_filename])) {
                        $objeto->titulo = $titulo;
                        $objeto->nombre_modelo = $fileNameOnly;
                        $objeto->tema_id = $tema;
                        $objeto->format = $extension;
                        $objeto->save();

                        return response()->json([
                            'estado' => 'ok',
                            'id' => $objeto->id,
                            'tipo' => 'update',
                            'objetos' => BdObjeto::whereId($objeto->id)->with([
                                'BdTema'
                            ])->get(),
                        ]);
                    }
                }

            } else {
                //Create
                $validador = Validator::make($request->all(), [
//                    'titulo' => 'required|unique:bd_objetos',
                    'file' => 'required',
                    'tema' => 'required',
                ]);
                if ($validador->fails()) {
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }


                $objeto = new BdObjeto();
                $objeto->titulo = $titulo;
                $objeto->nombre_modelo = $fileNameOnly;
                $objeto->src = $uploadedFileName;
                if ($extension == 'obj'){
                    $objeto->material = $uploadedMaterialName;
                }else{
                    $objeto->material = 'texto';
                }
                $objeto->tema_id = $tema;
                $objeto->format = $extension;
                $objeto->save();


                return response()->json([
                    'estado' => 'ok',
                    'id' => $objeto->id,
                    'tipo' => 'save',
                    'objetos' => BdObjeto::whereId($objeto->id)->with([
                        'BdTema'
                    ])->get(),
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'estado' => 'fail',
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
