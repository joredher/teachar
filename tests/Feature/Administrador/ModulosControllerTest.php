<?php

namespace Tests\Feature\Administrador;

use App\BdModulo;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModulosControllerTest extends TestCase
{

//    public function __construct(string $name = null, array $data = [], string $dataName = '')
//    {
//        parent::__construct($name, $data, $dataName);
//    }

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testIndex () {
        $user = User::find(1);
        Auth::login($user);
        $response = $this->get('/administracion/configuracion/modulos');
        $response->assertStatus(200);
    }


    public function testGuardarModulo () {
        $modulo = factory(BdModulo::class)->make()->toArray();
        $user = User::find(1);
        Auth::login($user);
        $response = $this->post('/administracion/configuracion/guardar-modulo', $modulo);
        $response->assertStatus(200);
    }

    public function testDestroy () {
        $modulo = BdModulo::where('id','=',2);
        $user = User::find(1);
        Auth::login($user);
        $response = $this->delete('/administracion/configuracion/eliminar-modulo', $modulo);
        $response->assertStatus(200);
    }
}
