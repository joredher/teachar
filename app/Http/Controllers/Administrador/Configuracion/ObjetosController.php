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
                $titulo = $objeto->titulo;
                $titleName = preg_replace("/[^a-zA-Z0-9\_\-]+/", "_", $titulo);
//                if ($objeto || $objeto->file_exists( storage_path($objeto->modelo)) && $objeto->file_exists( storage_path($objeto->material)))
                if ($objeto || $objeto->file_exists(storage_path($objeto->src)) && $objeto->file_exists(storage_path($objeto->material))) {
                    $objeto->delete();
                    Storage::disk('public')->delete([$objeto->src, $objeto->material]);
                    Storage::deleteDirectory('public/assets_ar/' . $this->getDir($objeto->tema_id) . '/' . $titleName);
//                    Storage::deleteDirectory(storage_path('public/assets_ar/' . $this->getDir($objeto->tema_id) . '/' . $titleName));
//                    &&
//                    Storage::file_exists(storage_path('public/assets_ar/' . $this->getDir($objeto->tema_id) . '/' . $titleName))
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
//                dd($objetos);
                foreach ($objetos as $objeto) {
                    $originalFileName = $objeto->getClientOriginalName();
                    $extension = $objeto->getClientOriginalExtension();
                    $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
//                    dd($extension);
                    switch ($extension) {
                        case ('gltf'):
                            $exten = $extension;
//                            dd($prueba);
                            $fileName = str_slug($fileNameOnly) . "." . $extension;
                            $uploadedFileName = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $fileName;
                            $objeto->storeAs('public', $uploadedFileName);
                            break;
                        case ('dae') :
                            $exten = $extension;
                            $fileName = str_slug($fileNameOnly) . "." . $extension;
                            $uploadedFileName = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $fileName;
                            $objeto->storeAs('public', $uploadedFileName);
                            break;
                        case ('obj') :
                            $exten = $extension;
                            if ($extension == 'obj'){
                                $fileName = str_slug($fileNameOnly) . "." . $extension;
                                $uploadedFileName = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $fileName;
                                $objeto->storeAs('public', $uploadedFileName);
                            }
                            break;
                        case ('mtl'):
                            $extenMtl = $extension;
                            $materialNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                            $materialName = str_slug($materialNameOnly) . "." . $extension;
                            $uploadedMaterialName = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $materialName;
                            $objeto->storeAs('public', $uploadedMaterialName);
                            break;
                        case ('bin'):
                            $extenBin = $extension;
                            $binNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                            $binName = str_slug($binNameOnly) . "." . $extension;
                            $uploadedBinName = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $binName;
                            $objeto->storeAs('public', $uploadedBinName);
                            break;
                        default:
                            $defaultNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                            $defaultName = str_slug($defaultNameOnly) . "." . $extension;
                            $uploadedDefaultName = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $defaultName;
                            $objeto->storeAs('public', $uploadedDefaultName);
//                            if ($extension == ''){
////                                $extenImage = $extension;
//                                $imageName = str_slug($fileNameOnly) . "." . $extension;
//                                $uploadedImageName = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $imageName;
//                                $objeto->storeAs('public', $uploadedImageName);
//                            }else{
//
//                            }
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
                if (Input::get('titulo')){
                    $objeto->titulo = $titulo;
                }elseif($request->get('titulo') == $objeto->titulo){
                    $objeto->titulo = $objeto->titulo;
                }
                if ($request->file('file')) {
                    $objeto->nombre_modelo = $fileNameOnly;
                    $old_filename = '/public/' . $objeto->src;
                    $old_material = '/public/' . $objeto->material;
                    $objeto->src = $uploadedFileName;
                    Storage::disk('local')->delete($old_filename);
                    if ($extension == 'obj') {
                        $objeto->material = $uploadedMaterialName;
                        Storage::disk('local')->delete($old_material);
                    }else{
                        $objeto->material = 'texto';
                        Storage::disk('local')->delete($old_material);
                    }
                    $objeto->format = $extension;
                }
                if ($request->get('tema')){
                    $objeto->tema_id = $tema;
                }elseif ($request->get('tema') == $objeto->tema_id){
                    $objeto->tema_id = $request->get('tema');
                }
                $objeto->scaleInc = 1;
                $objeto->scale = '1 1 1';
                $objeto->positionH = '0 0 0';
                $objeto->rotationH = '0 180 0';
                $objeto->positionV = '0 0.5 0';
                $objeto->rotationV = '90 180 0';
                $objeto->save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $objeto->id,
                    'tipo' => 'update',
                    'objetos' => BdObjeto::whereId($objeto->id)->with([
                        'BdTema'
                    ])->get(),
                ]);

            } else {
                //Create
                $validador = Validator::make($request->all(), [
                    'titulo' => 'required|unique:bd_objetos',
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
                if ($extension == 'obj' && $extenMtl == 'mtl'){
                    $objeto->material = $uploadedMaterialName;
                }elseif ($extension == 'gltf'){
                    $objeto->material = 'untexto';
                }elseif($extenBin == 'bin'){
                    $objeto->material = $uploadedBinName;
                }

                $objeto->tema_id = $tema;
                if ($extension != $exten){
                    $objeto->format = $exten;
                }else{
                    $objeto->format = $extension;
                }
                $objeto->scaleInc = 1;
                $objeto->scale = '1 1 1';
                $objeto->positionH = '0 0 0';
                $objeto->rotationH = '0 180 0';
                $objeto->positionV = '0 0 0';
                $objeto->rotationV = '90 180 0';
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
