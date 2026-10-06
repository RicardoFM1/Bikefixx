<?php


namespace App\Http\Controllers;

use App\Models\Usuarios;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller;

class UsuarioController extends Controller
{
    public function listarUsuarios()
    {
        $usuarios = Usuarios::with('clientes')->with('mecanicos')->get();

        $usuarios->makeHidden('senha');

        return response()->json([
            'sucesso' => true,
            'dados' => $usuarios
        ], 200);
    }

    public function fazerLogin(Request $request)
    {
        try {

            $usuario = Usuarios::where('email', $request->input('email'))->first();

            if (empty($usuario)) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Credenciais inválidas'
                ], 401);
            }


            $senhaCorreta = Hash::check($request->input('senha'), $usuario->senha);

            if (!$senhaCorreta) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Credenciais inválidas'
                ], 401);
            }

            $payload = [
                'exp' => time() + 3600,
                'dados' => [
                    'id' => $usuario->id,
                    'perfil' => $usuario->perfil
                ]
            ];

            $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');


            $usuario->update(['token' => $jwt]);


            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Usuário logado com sucesso',
                'token' => $jwt
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Erro ao tentar fazer login'
            ], 500);
        }
    }
}
