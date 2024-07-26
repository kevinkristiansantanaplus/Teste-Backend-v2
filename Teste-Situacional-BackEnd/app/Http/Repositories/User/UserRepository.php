<?php

namespace App\Http\Repositories\User;

use App\Models\User;

class UserRepository implements UserInterface
{

    public function getAll(): array
    {

        return User::all()->toArray();

    }

    public function getById(int $id): ?User
    {

        return User::find($id);

    }

}