<?php

namespace App\Http\Controllers;

use App\BdModulo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('step');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin','profe']);

        if ($request->user()->hasRole('profe')){
            return redirect()->route('index');
        }else{
            return redirect()->route('/');
        }
//        if($request->user()->hasRole('admin')){
//            return redirect()->route('/');
//        }

    }
}
