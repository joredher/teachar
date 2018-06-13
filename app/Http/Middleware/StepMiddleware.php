<?php

namespace App\Http\Middleware;

use App\Listeners\LogSuccessfulLogin;
use App\User;
use Carbon\Carbon;
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

//        if ($request->user()->hasRole('profe') && $request->user()->last_login_at !== null) {
//            return redirect('usuario/index');
//        }else
        $times = Carbon::now()->addMinute(5)->diffForHumans();
        $ultimo = Carbon::parse($request->user()->current_sign_in_at)->diffForHumans();
        if($request->user()->hasRole('profe') && $request->user()->last_login_at === null ){
            $user = User::where('id', '=', $request->user()->id)->firstOrFail();
//            return dd($user);
            return response()->view('helpers.form-step.formStep', compact('user'));
        }

        return $next($request);
    }
}
