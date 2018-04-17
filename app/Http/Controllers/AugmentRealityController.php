<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AugmentRealityController extends Controller
{
    public function index(){
        return view('realidad_aumentada.index_ra');
    }
}
