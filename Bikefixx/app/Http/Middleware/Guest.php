<?php

namespace App\Http\Middleware;
use Closure;

class Guest
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if ($token) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Usuário já autenticado'
            ], 403);
        }

        return $next($request);
    }
}
