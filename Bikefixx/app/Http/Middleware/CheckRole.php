<?php

namespace App\Http\Middleware;

use App\Models\Usuarios;
use Closure;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $token = $request->header('Authorization');

        $tokenPartes = explode(' ', $token);

        $usuario = Usuarios::where('token', $tokenPartes[1])->first();

        if (empty($usuario)) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Usuário não autenticado'
            ], 401);
        }

        if (!in_array($usuario->perfil, $roles)) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Sem permissão'
            ], 403);
        }

        $dadoUsuario = [
            'id' => $usuario->id,
            'nome' => $usuario->nome,
            'email' => $usuario->email,
            'perfil' => $usuario->perfil
        ];

        $request->auth = $dadoUsuario;

        return $next($request);
    }
}
