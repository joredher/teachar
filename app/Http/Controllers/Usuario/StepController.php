<?php

namespace App\Http\Controllers\Usuario;

use App\BdTema;
use App\File;
use App\User;
use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Validation\Rule;

class StepController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function guardar(Request $request){
            $user = User::find($request->id);
            if ($request->last_login_at == null){
                $time = Carbon::now();
                $user->last_login_at = $time;
            }
            $user->save();
            return response()->json([
                'estado' => 'ok',
                'id' => $user->id,
                'tipo' => 'update'
            ]);

    }
}
