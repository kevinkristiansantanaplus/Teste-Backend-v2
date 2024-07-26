<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetAllTest extends TestCase
{

    use RefreshDatabase;

    private $token;

    public function setUp(): void
    {

        parent::setUp();

        // Cria um usuário e obtém o token JWT para autenticação dos testes
        $user = User::factory()->create();
        $this->token = JWTAuth::fromUser($user);

    }

    /** @test */
    public function it_can_list_all_users()
    {

        // Cria uma quantidade de usuários no banco de testes
        $users = User::factory()->count(3)->create();

        // Cria uma solicitação no recurso da API 
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                          ->getJson('/api/v1/users');

        // Verifica o status code, a quantidade de usuários que foram criados e se os emails coincidem
        $response->assertStatus(200)
                 ->assertJsonCount(4)
                 ->assertJsonFragment(['email' => $users[0]->email])
                 ->assertJsonFragment(['email' => $users[1]->email])
                 ->assertJsonFragment(['email' => $users[2]->email]);

    }

    /** @test */
    public function it_can_get_a_user_by_id()
    {

        // Cria um usuário na base de dados
        $user = User::factory()->create();

        // Cria uma solicitação no recurso da API
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
                         ->getJson("/api/v1/users/{$user->id}");

        // Verifica o status code e se o email coincidem
        $response->assertStatus(200)
                 ->assertJsonFragment(['email' => $user->email]);

    }

}