<?php

namespace App\Http\Middleware;

use App\Models\Usuarios;
use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use UnexpectedValueException;

class Auth
{

    public function handle($request, Closure $next)
    {
        try {

            $token = $request->header('Authorization');

            if (empty($token)) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Usuário não autenticado'
                ], 401);
            }

           

            return $next($request);
        } catch (SignatureInvalidException) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Token inválido'
            ], 401);
        } catch (ExpiredException) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Token expirado'
            ], 401);
        } catch (UnexpectedValueException) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Token inválido'
            ], 401);
        }
    }
}
