<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Services\UserService;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="API", version="1.0")
 */
class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService) {

        $this->userService = $userService;

    }

    public function getAll()
    {

        try
        {

            $user =  $this->userService->getAll();

            return response()->json([

                'message' => 'Registro encontrado com sucesso.',
                'body'    => $user

            ], 200);            

        }
        catch(\Exception $e)
        {

            return response()->json([

                'message' => 'Houve um erro interno, favor contate o suporte.'

            ], 500);

        }

    }

    public function getById($id)
    {

        try
        {

            $user =  $this->userService->getById($id);

            if($user)
            {

                return response()->json([

                    'message' => 'Registro encontrado com sucesso.',
                    'body'    => $user
    
                ], 200);

            }
            
            return response()->json([

                'message' => 'Registro não encontrado.'

            ], 404);

        }
        catch(\Exception $e)
        {

            return response()->json([

                'message' => 'Houve um erro interno, favor contate o suporte.'

            ], 500);

        }

    }

}