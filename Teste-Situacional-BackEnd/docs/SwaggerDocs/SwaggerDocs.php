<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Documentação",
 *     version="1.0.0",
 *     description="Documentação da API"
 * )
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Teste Back End"
 * )
 */
class SwaggerDocs
{
    /**
     * @OA\Get(
     *     path="/api/v1/users",
     *     summary="Busca todos os usuários",
     *     tags={"Users"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista todos usuários",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno"
     *     )
     * )
     */
    public function listUsers() {}

    /**
     * @OA\Get(
     *     path="/api/v1/users/{id}",
     *     summary="Busca um usuário pelo ID",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Id do usuário",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno"
     *     )
     * )
     */
    public function getUserById() {}

    /**
     * @OA\Post(
     *     path="/api/v1/auth/register",
     *     summary="Registrar um novo usuário",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password", "password_confirmation"},
     *             @OA\Property(property="name", type="string", example="Kevin Kristian"),
     *             @OA\Property(property="email", type="string", format="email", example="kevin-kristian@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="********")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cadastro realizado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Usuário registrado com sucesso")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Valores inválidos",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validation errors")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function registerUser() {}

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Login a user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="kevin-kristian@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="********")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Autenticado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Acesso não autorizado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Credenciais inválidas")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function loginUser() {}
}

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     required={"name", "email", "password"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Kevin Kristian"),
 *     @OA\Property(property="email", type="string", format="email", example="kevin-kristian@example.com"),
 *     @OA\Property(property="password", type="string", format="password", example="********"),
 * )
 */