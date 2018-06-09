<?php

namespace App\Http\Middleware;

use App\BdModulo;
use App\BdTema;
use Closure;

class TemaModulosMiddleware
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
        $modulos = BdModulo::where('slug', '=', $request->slug)->get();
        foreach ($modulos as $modulo){
            $estado = $modulo->estado;
            if ($estado == 'Inactivo'){
                return redirect('errors.404', 301);
            }

        }
        $temas = BdTema::where('slug', '=', $request->slug)->get();
        foreach ($temas as $tema){
//            dd($tema);
            $estado = $tema->estado;
            if ($estado == 'Inactivo'){
                return redirect('errors.404');
            }
        }


        return $next($request);
    }
}
