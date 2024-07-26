<?php

namespace App\Http\Repositories\Auth;

use App\Models\User;

interface AuthInterface
{

    public function register($user): User;

}