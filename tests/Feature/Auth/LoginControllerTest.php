<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLogin () {
        $user = User::find(1);
        $response = $this->get(Auth::login($user));
        $response->assertStatus(302);
//        $response->assertStatus(200);
    }
}
