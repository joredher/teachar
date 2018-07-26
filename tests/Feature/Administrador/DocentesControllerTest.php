<?php

namespace Tests\Feature\Administrador;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocentesControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex () {
        $user = User::find(1);
        Auth::login($user);
        $response = $this->get('/administracion/configuracion/docentes');
        $response->assertStatus(200);
    }

    public function testGuardar () {
        $docente = factory(User::class)->make()->toArray();
        $user = User::find(1);
        Auth::login($user);
        $response = $this->post('/administracion/configuracion/guardar-docente', $docente);
        $response->assertStatus(200);
    }

    public function testDestroy () {
        $docente = BdObjeto::where('id','=',2);
        $user = User::find(1);
        Auth::login($user);
        $response = $this->delete('/administracion/configuracion/eliminar-docente', $docente);
        $response->assertStatus(200);
    }
}
