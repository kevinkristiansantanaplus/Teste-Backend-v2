<?php

namespace App\Http\Repositories\User;

use App\Models\User;

interface UserInterface
{

    public function getAll(): array;

    public function getById(int $id): ?User;

}