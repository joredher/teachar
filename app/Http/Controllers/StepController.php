<?php

namespace App\Http\Controllers;

use App\BdTema;
use App\File;
use App\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class StepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function guardar(Request $request){
        $request->user()->authorizeRoles('profe');

        $user = new User();
        $user -> last_login_at = $request->last_login_at;
        $user->save();
    }

//    public function show(Request $request){
//        $usuario = User::all();
//        return compact($usuario);
//    }

//    private $file_ext = ['OBJ','obj','fbx','FBX'];
//    private $material_ext = ['mtl'];
//    private $image_ext = ['jpg','jpeg','png','gif','svg'];

//    public function index(Request $request){
////        $request->user()->authorizeRoles('profe');
//        return view('helpers.form-step.formStep');
//    }



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
//            $max_size = (int)ini_get('upload_max_filesize') * 1000;
//            $all_ext = implode(',', $this->allExtensions());
//
//            if ($request->id != ''){
//                //update
//                $validador = Validator::make($request->all(),
//                    [
//                        'file_name' => ['required', Rule::unique('files')->ignore($request->id)],
//                    ]);
//
//                if ($validador->fails()){
//                    return response()->json([
//                        'estado' => 'validador',
//                        'errors' => $validador->errors()
//                    ]);
//                }
//                $objeto = File::find($request->id);
//                $objeto -> file_name = $request->file_name;
//                $objeto -> descripcion = $request->descripcion;
//                $objeto-> foto = '';
//                if ($request->foto){
//                    $objeto->foto = $request->foto;
////                    $modulo->foto = $fileName;
//                }
//                $objeto -> tema_id = $request->tema_id;
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
//                    'file_name' =>  'required|unique:files',
//                    'objeto' => 'required|mimes:' . $all_ext . '|max:' . $max_size,
//                    'material' => 'required|mimes:' . $all_ext . '|max:' . $max_size,
//                    'tema_id' => 'required'
//                ]);
//                if ($validador->fails()){
//                    return response()->json([
//                        'estado' => 'validador',
//                        'errors' => $validador->errors()
//                    ]);
//                }
////                $objeto = new File();
////                $objeto -> file_name = $request->file_name;
////                $objeto -> descripcion = $request->descripcion;
////                if($request->foto){
////                    $objeto->foto = $request->foto;
//////                    $modulo->foto = $fileName;
////                }
////                $objeto -> estado = $request->estado;
////                $objeto -> tema_id = $request->tema_id;
////                $objeto -> save();
//
//                return response()->json([
//                    'estado' => 'ok',
//                    'id' => dd("Ready to upload"),
//                    'tipo' => 'save',
//                ]);
//            }
//        } catch (\Exception $exception){
//            return response()->json([
//                'estado' => 'fail',
//                'error' => $exception->getMessage(),
//
//
//    private function allExtensions()
//            {
//                return array_merge($this->file_ext, $this->material_ext, $this->image_ext);
//            }
//
//    /**
//     * Get directory for the specific user
//     * @return string Specific user directory
//     */
//    private function getTemaDir()
//            {
//                $temas = BdTema::all();
//
//                foreach ($temas as $tema){
//                    $dire = $tema->name . '_' . $tema->id;
//                }
//                return $dire;
//            }
//
//    public function store(Request $request){
////        $max_size = (int)ini_get('upload_max_filesize') * 1000;
////        $all_ext = implode(',', $this->allExtensions());
//
//                $request->validate([
////            'title' =>  'required',
////            'file_name' => '',
//                ]);
//
//                $objetos = $this->uploadFiles($request);
//
//                foreach ($objetos as  $objetoFile){
//
//                    list($fileName, $title) = $objetoFile;
//
//                    $objeto = new File();
//                    $objeto->title = $title;
//                    $objeto->file_name = $fileName;
//                    $objeto->save();
////        $objeto->file_name = $this->uploadFile($request);
//                }
//
//                return response()->json([
//                    'uploaded' => true
//                ]);
//
////        return redirect('administracion/configuracion/obtener-files')->with('message', ' Se ha cargado el archivo!');
//
////        dd("Ready to upload");
//            }
//
//    protected function uploadFiles($request){
//                $uploadedFiles = [];
//
//                if ($request->hasFile('file_name'))
//                {
//                    $objetos = $request->file('file_name');
//
//                    foreach ($objetos as $objeto){
//                        $uploadedFiles[] =$this->uploadFile($objeto);
//                    }
//
//                }
//
//                return $uploadedFiles;
//
//            }
//
//    protected function uploadFile($request){
//
//                $objeto = $request->file('file_name');
//                $originalFileName = $objeto->getClientOriginalName();
//                $ext = $objeto->getClientOriginalExtension();
//                $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
//                $fileName = str_slug($fileNameOnly) . "-" . time() . "." . $ext;
//                $uploadedFileName = $objeto->storeAs('public', $fileName);
//
//                return [$uploadedFileName, $fileNameOnly];
//
//            }
//            ]);
//        }
//    }
}
