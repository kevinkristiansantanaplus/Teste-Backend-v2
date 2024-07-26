<?php

namespace App\Http\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthInterface
{

    // Cadastra o usuário no Banco de Dados
    public function register($user): User
    {

        $newUser = new User();

        $newUser->name     = $user['name'];
        $newUser->email    = $user['email'];
        $newUser->password = Hash::make($user['password']);

        $newUser->save();

        return $newUser;

    }

}