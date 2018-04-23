<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\BdObjeto;
use App\BdTema;
use Dotenv\Validator;
use Illuminate\Http\Request;
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
        return view('administracion.configuracion.objetos.index');
    }

    public function obtenerObjetos(Request $request){
        try{
            $request = json_decode($request->getContent());
            $objetos = BdObjeto::Buscar($request->datos->busqueda)->with('BdTema')
                ->orderBy('id','asc')
                ->paginate(3);
            //dd($modulos);
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

    public function guardar(Request $request){
        try{

            $uploadedFiles = $request->pics;
            dd($request->pics);
            foreach ($uploadedFiles as $file){

//                $file->store('dummy');
                $originalFileName = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $fileNameOnly = pathinfo($originalFileName, PATHINFO_FILENAME);
                $fileName = str_slug($fileNameOnly) . "-" . time() . "." . $ext;
//                $uploadedFileName = Storage::putFileAS('/public/' . $this->getTemaDir() . '/' . $fileName);
////                $uploadedFileName = $file->storeAs("public/", $this->getTemaDir() . "/" . $fileName);
//                $archiv = [$uploadedFileName, $fileNameOnly];

//                dd($archiv);

                if ($originalFileName . $ext === $originalFileName.'.obj'){
                    $archiv = $fileName->store($this->getTemaDir());
                }
                if ($originalFileName . $ext === $originalFileName.'.mtl'){
                    $material = $fileName->store($this->getTemaDir());
                }
                if ($originalFileName . $ext === $originalFileName.'.png'){
                    $capaOne = $fileName->store($this->getTemaDir());
                }
            }
            if ($request->id != ''){
                //update
                $validador = Validator::make($request->all(),
                    [
                        'nombre' => ['required', Rule::unique('bd_objetos')->ignore($request->id)],
                        'tema_id' => 'required'
                    ]);

                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $objeto = BdObjeto::find($request->id);
                $objeto -> file_name = $request->file_name;
                $objeto -> objeto = $archiv;
                $objeto -> material = $material;
                $objeto -> capaOne = $capaOne;
                $objeto -> capaTwo = $capaTwo;
                $objeto -> tema_id = $request->tema_id;
                $objeto -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $objeto ->id,
                    'tipo' => 'update'
                ]);
            }
            else{
                //Create
                $validador = Validator::make($request->all(),[
                    'nombre' =>  'required|unique:bd_objetos',
                    'tema_id' => 'required'
                ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }
                $objeto = new BdObjeto();
                $objeto -> file_name = $request->file_name;
                $objeto -> objeto = $archiv;
                $objeto -> material = $material;
                $objeto -> capaOne = $capaOne;
                $objeto -> capaTwo = $capaTwo;
                $objeto -> tema_id = $request->tema_id;
                $objeto -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $objeto-> id,
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

    private function getTemaDir()
    {
        $temas = BdTema::all();

        foreach ($temas as $tema){
            $dire = $tema->name . '_' . $tema->id;
        }
        return $dire;
    }
}
