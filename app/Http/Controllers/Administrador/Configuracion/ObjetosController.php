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

        private $file_ext = ['obj','gltf','dae'];
        private $material_ext = ['mtl','bin'];
        private $image_ext = ['jpg','jpeg','png','PNG','JPG'];

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
                            if ($extension === 'png' || $extension == 'jpg') {
                                $defaultNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                                $defaultName = str_slug($defaultNameOnly) . "." . $extension;
                                $uploadedDefaultName = 'assets_ar/' . $this->getDir($request->get('tema')) . '/' . $titleName . '/' . $defaultName;
                                $objeto->storeAs('public', $uploadedDefaultName);
                            }
                    }
                }
            }

            $all_ext = implode(',', $this->file_ext);
//            $all_ext = implode(',', $this->allExtensions());

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
                }

                $objeto->tema_id = $tema;
                if ($extension != $exten){
//                    unset($extension);
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
