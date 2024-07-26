<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Http\Repositories\Auth\AuthRepository;
use App\Models\User;
use Illuminate\Http\Request;

class AuthService
{

    private $authRepository;

    // Realiza a injeção de dependência do repositório
    public function __construct(AuthRepository $authRepository) {

        $this->authRepository = $authRepository;

    }

    // Método para registar o usuário
    public function register(Request $params): User
    {

        return $this->authRepository->register($params);

    }

    // Método para autenticar o usuário
    public function authentication(array $credentials): string
    {

        // Verifica as credenciais do usuário para autenticá-lo
        $token = auth('api')->attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);

        if(!$token)
        {

            // Lança uma exceção personalizada caso o usuário não seja autenticado
            throw new CustomException('Usuário não autenticado.', 401);

        }

        return $token;

    }

}