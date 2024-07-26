<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Http\Repositories\User\UserRepository;
use App\Models\User;
use Exception;

class UserService
{

    private $userRepository;

    public function __construct(UserRepository $userRepository) {

        $this->userRepository = $userRepository;

    }

    public function getAll(): array
    {

        return $this->userRepository->getAll();

    }

    public function getById(int $id): User
    {

        $user = $this->userRepository->getById($id);

        return $user;

    }

}