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

    public function allExtensions(){
        return array_merge($this->file_ext, $this->material_ext, $this->image_ext);
    }

    public function destroy(Request $request)
    {
        try {
            if ($request->id != '') {
                $id = $request->get('id');
                $objeto = BdObjeto::find($id);
                $titulo = $objeto->titulo;
                $titleName = preg_replace("/[^a-zA-Z0-9\_\-]+/", "_", $titulo);
                if ($objeto || $objeto->file_exists(storage_path($objeto->src)) && $objeto->file_exists(storage_path($objeto->material))) {
                    $objeto->delete();
                    Storage::disk('public')->delete([$objeto->src, $objeto->material]);
                    Storage::deleteDirectory('public/assets_ar/' . $this->getDir($objeto->tema_id) . '/' . $titleName);
                    return response()->json([
                        'estado' => 'ok',
                        'id' => $objeto->id,
                        'tipo' => 'delete',
                    ]);
                }
                $data['success'] = false;
                return $data;
            }
        } catch (\Exception $exception) {
            return response()->json($exception);
        }
    }

    private function getDir($id)
    {
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

            if ($request->get('tema')) { $tema = $request->get('tema'); }

            if ($request->hasFile('file')){
                $objetos = $request->file('file');
                foreach ($objetos as $objeto) {
                    $originalFileName = $objeto->getClientOriginalName();
                    $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $rutaArchivo = 'assets_ar/'. $this->getDir($request->get('tema')) . '/' .$titleName . '/' . $fileNameOnly;
                    Storage::extractTo('public/' . $rutaArchivo, $objeto->path());
                    $files = Storage::files('public/' . $rutaArchivo);

                    foreach ($files as $key=>$file) {
                        $arch = $files[$key];
                        $exp1 = explode('/', $arch);
                        $exp2 = explode('.', array_last($exp1));
                        $nameFi = $exp2[0];
                        if (array_key_exists(1, $exp1) && array_key_exists(1, $exp2)) {
                            $extension = $exp2[1];
                            switch ($extension) {
                                case ('gltf'):
                                    $exten = $extension;
                                    $fileName = $nameFi;
                                    $uploadedFileName = substr($arch, 7);
                                    break;
                                case ('dae') :
                                    $exten = $extension;
                                    $fileName = $nameFi;
                                    $uploadedFileName = substr($arch, 7);
                                    break;
                                case ('obj') :
                                    $exten = $extension;
                                    if ($extension == 'obj'){
                                        $fileName = $nameFi;
                                        $uploadedFileName = substr($arch, 7);
                                    }
                                    break;
                                case ('mtl'):
                                    $extenMtl = $extension;
                                    $materialNameOnly = $nameFi;
                                    $materialName = $materialNameOnly;
                                    $uploadedMaterialName = substr($arch, 7);
                                    break;
                                case ('bin'):
                                    $extenBin = $extension;
                                    $binNameOnly = $nameFi;
                                    $binName = $binNameOnly;
                                    $uploadedBinName = substr($arch, 7);
                                    break;
                                case ('fbx'):
                                    $exten = $extension;
                                    $fileName = $nameFi;
                                    $uploadedFileName = substr($arch, 7);
                                    break;
                                default:
                                    if ($extension === 'png' || $extension == 'jpg') {
                                        $defaultNameOnly = $nameFi;
                                        $defaultName = $defaultNameOnly;
                                        $uploadedDefaultName = substr($arch, 7);
                                    }
                            }
                        } else {
                            $defaultNameOnly = $nameFi;
                            $defaultName = $defaultNameOnly;
                            $uploadedDefaultName = substr($arch, 7);
                        }
                    }
                }
            }

            if ($request->id != '') {
                //update
                $validador = Validator::make($request->all(),
                    [
                        'titulo' => ['required', Rule::unique('bd_objetos')->ignore($request->id)],
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

                switch ($exten){
                    case ('obj'):
                        if (isset($extenMtl) || $extenMtl != ''){
                            $objeto->material = $uploadedMaterialName;
                        }else{
                            unset($extenMtl);
                            $objeto->material = 'default';
                        }
                        break;
                    case ('gltf'):
                        if (isset($extenBin)){
                            $objeto->material = $uploadedBinName;
                        }else{
                            unset($extenBin);
                            $objeto->material = 'default';
                        }
                        break;
                    case ('fbx'):
                        $objeto->material = 'default';
                        break;
                    case ('dae'):
                        $objeto->material = 'default';
                        break;
                }

                $objeto->tema_id = $tema;
                if ($extension != $exten){
                    $objeto->format = $exten;
                }else{
                    $objeto->format = $extension;
                }
                $objeto->scaleInc = 0.5;
                $objeto->scale = '0.5 0.5 0.5';
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
