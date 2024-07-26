<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function a_user_can_login()
    {

        // Cria um usuário na base de dados de teste
        User::factory()->create([

            'email'    => 'test@example.com',
            'password' => Hash::make('123456'),

        ]);

        // Faz uma requisição no recurso passando os dados do usuário criado acima
        $response = $this->postJson('/api/v1/auth/login', [

            'email'    => 'test@example.com',
            'password' => '123456',

        ]);

        // Verifica se o status é 200 e se vem com a mensagem e o Token JWT
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'message', 
                    'body' => [
                        'access_token',
                    ],
                ]);

        $this->assertIsString($response->json('body.access_token'));

    }

    /** @test */
    public function login_fails_with_invalid_credentials()
    {

        // Faz uma requisição no recurso com uns dados de teste
        $response = $this->postJson('/api/v1/auth/login', [

            'email' => 'invalid@example.com',
            'password' => '654321',

        ]);

        $response->assertStatus(401);
        $response->assertJson(["message" => "Usuário não autenticado."]);

    }

}