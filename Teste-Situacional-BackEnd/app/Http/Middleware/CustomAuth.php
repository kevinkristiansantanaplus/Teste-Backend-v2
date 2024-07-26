<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{

    public function handle($request, Closure $next)
    {

        // Verifica se o usuário está autenticado
        if (!auth('api')->user()) {

            // Retorna uma resposta JSON caso não esteja autenticado
            return response()->json([
                'message' => 'Usuário não autenticado.'
            ], 401);

        }

        return $next($request);

    }

}