<?php

namespace Tests\Feature\Administrador;

use App\BdObjeto;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ObjetosControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testIndex () {
        $user = User::find(1);
        Auth::login($user);
        $response = $this->get('/administracion/configuracion/objetos');
        $response->assertStatus(200);
    }

    public function testGuardar () {
        $objeto = factory(BdObjeto::class)->make()->toArray();
        $user = User::find(1);
        Auth::login($user);
        $response = $this->post('/administracion/configuracion/guardar-objeto', $objeto);
        $response->assertStatus(200);
    }

    public function testDestroy () {

        $objeto = BdObjeto::where('id','=',2);
        $user = User::find(1);
        Auth::login($user);
        $response = $this->delete('/administracion/configuracion/eliminar-objeto', $objeto);
        $response->assertStatus(200);
    }
}
