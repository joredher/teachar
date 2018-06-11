<?php

namespace App\Http\Middleware;

use App\Listeners\LogSuccessfulLogin;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class StepMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->user()->hasRole('profe') && $request->user()->last_login_at !== null) {
            return redirect('usuario/index');
        }elseif($request->user()->hasRole('profe') && $request->user()->last_login_at === null){
//            return dd($request->user()->last_login_at);
            $request->user()->authorizeRoles('profe');
            $user = User::where('id', '=', $request->user()->id)->firstOrFail();
//            return dd($user);
            return response()->view('helpers.form-step.formStep', ['user' => $user]);
        }
        //            return redirect('usuario/modulos-usuario');
//            return dd($request->user()->last_login_at);
//        }elseif($request->user()->authorizeRoles('admin')){
////            return redirect('administracion/configuracion/home');
//            return dd('Hola mundo');
//        }

        return $next($request);
    }
}
