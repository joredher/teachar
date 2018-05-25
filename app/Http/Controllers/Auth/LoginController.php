<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

//    public function authenticated(Request $request)
//    {
//        // Logic that determines where to send the user
//        if($request->user()->hasRole('profe')){
//            return view('usuarion.configuracion.index');
//        }
//
//        if($request->user()->hasRole('admin')){
//            return view('administracion.configuracion.index');
//        }
//    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $login = $request->input($this->username());
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
//        return $request->only($this->username(), 'password'); Tener Encuenta por si suceden errores de autenticación
//        return ['username'=>$request->{$this->username()},'password'=>$request->password, 'state'=>'Activo'];
        return [$field => $login,'password'=>$request->password, 'state'=>'Activo'];
    }

    public function username()
    {
        return 'login';
    }

}
