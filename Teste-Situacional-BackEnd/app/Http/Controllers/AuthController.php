<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    private $authService;

    public function __construct(AuthService $authService) {

        $this->authService = $authService;

    }

    public function register(Request $request)
    {

        //Valida os dados de entrada
        $validator = Validator::make($request->all(), [

            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);

        }

        try
        {

            $this->authService->register($request);

            return response()->json([

                'message' => 'Usuário cadastrado com sucesso.'

            ], 201);

        }
        catch(\Exception $e)
        {

            return response()->json([

                'message' => 'Houve um erro interno, favor contate o suporte.'

            ], 500);

        }

    }

    public function login(Request $request)
    {

        //Valida os dados de entrada
        $validator = Validator::make($request->all(), [

            'email'    => 'required|email',
            'password' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);

        }

        // Passa somente as credenciais do usuário para o Service
        $credentials = $request->only('email', 'password');

        try
        {

            $token = $this->authService->authentication($credentials);

            return response()->json([

                'message'      => 'Login realizado com sucesso.',
                'access_token' => $token

            ], 200);

        }
        // Trata a Exceção personalizada
        catch (CustomException $e)
        {

            return response()->json([

                'message' => $e->getMessage()

            ], $e->getStatusCode());

        }
        catch(\Exception $e)
        {

            return response()->json([

                'message' => 'Houve um erro interno, favor contate o suporte.'

            ], 500);

        }

    }

}