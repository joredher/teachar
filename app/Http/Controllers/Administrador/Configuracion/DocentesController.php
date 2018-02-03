<?php

namespace App\Http\Controllers\Administrador\Configuracion;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocentesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function vIndex(Request $request){
        $request->user()->authorizeRoles('admin');
        return view('administracion.configuracion.docentes.index');
    }

    public function obtener(Request $request){
        try{
            $request = json_decode($request->getContent());
            $users = User::Buscar($request->datos->busqueda)->with('roles')->orderBy('id','asc')->paginate(6);
//            $users = User::whereHas('roles', function ($query){
//               $query->where('name','profe');
//            })->paginate(6);

            return response()->json($users);

        }catch (\Exception $exception){
            return response()->json($exception);
        }
    }


    public function destroy(Request $request){
        try{
            if ($request->id != ''){
                $id = $request->get('id');
                $user = User::find($id);
                foreach ($user->roles as $role){
                    echo $role->pivot->role_id;
                }
                if ($user){
                    $user->delete();
                    $data['success'] = true;
                    return $data;
                }
                $data['success'] = false;
                return $data;
            }
        }catch (\Exception $exception){
            return response()->json($exception);
        }


    }

    public function guardarDocente(Request $request){
        try{
            if ($request->id != ''){
                //update
                $validador = Validator::make($request->all(),
                    [
                        'identification' => ['required', Rule::unique('users')->ignore($request->id)],
                        'name' => 'required',
                        'last_name' => 'required',
                        'username' => ['required', Rule::unique('users')->ignore($request->id)],
                        'email' => ['required', Rule::unique('users')->ignore($request->id)],
                    ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $docente = User::find($request->id);
                $docente -> identification = $request->identification;
                $docente -> name = $request->name;
                $docente -> last_name = $request->last_name;
                $docente -> username = $request->username;
                $docente -> email = $request->email;
                $docente -> state = $request->state;
                $docente -> save();

                return response()->json([
                    'estado' => 'ok',
                    'id' => $docente->id,
                    'tipo' => 'update'
                ]);

            }else{
                //Create
                $validador = Validator::make($request->all(),[
                    'identification' =>  'required | unique:users',
                    'name' => 'required',
                    'last_name' => 'required',
                    'username' =>  'required | unique:users',
                    'email' =>  'required | unique:users',
                ]);
                if ($validador->fails()){
                    return response()->json([
                        'estado' => 'validador',
                        'errors' => $validador->errors()
                    ]);
                }

                $docente = new User();
                $docente -> identification = $request->identification;
                $docente -> name = $request->name;
                $docente -> last_name = $request->last_name;
                $docente -> username = $request->username;
                $docente -> email = $request->email;
                $docente -> password = Hash::make($request->identification);
                $docente -> state = $request->state;
                $docente -> save();
                $docente -> roles()->attach(2);

                return response()->json([
                    'estado' => 'ok',
                    'id' => $docente->id,
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

//                foreach ($docente->roles()->get() as $rol){
//                    var_dump($rol->name);
//                }
////                dd($request->$docente); //$docente -> user_id = Auth::user()->id;
