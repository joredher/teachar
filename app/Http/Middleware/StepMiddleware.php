<?php

namespace App\Http\Middleware;

use Closure;

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
//            return redirect('usuario/modulos-usuario');
            return redirect('usuario/index');
        }elseif($request->user()->hasRole('profe') && $request->user()->last_login_at === null){
            return dd('No puedes hacer nada.');
        }
//            return dd($request->user()->last_login_at);
//        }elseif($request->user()->authorizeRoles('admin')){
////            return redirect('administracion/configuracion/home');
//            return dd('Hola mundo');
//        }

        return $next($request);
    }
}
