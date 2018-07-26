<?php

namespace Tests\Feature\Administrador;

use App\BdTema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemasControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex () {
        $user = User::find(1);
        Auth::login($user);
        $response = $this->get('/administracion/configuracion/temas');
        $response->assertStatus(200);
    }

    public function testGuardar () {
        $tema = factory(BdTema::class)->make()->toArray();
        $user = User::find(1);
        Auth::login($user);
        $response = $this->post('/administracion/configuracion/guardar-tema', $tema);
        $response->assertStatus(200);
    }

    public function testDestroy () {
        $tema = BdTema::where('id','=',2);
        $user = User::find(1);
        Auth::login($user);
        $response = $this->delete('/administracion/configuracion/eliminar-tema', $tema);
        $response->assertStatus(200);
    }
}
