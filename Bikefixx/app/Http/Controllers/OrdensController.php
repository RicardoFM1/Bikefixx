<?php

namespace App\Http\Controllers;

use App\Models\Bicicletas;
use App\Models\Clientes;
use App\Models\OrdensDeServico;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class OrdensController extends Controller
{
    public function listarOrdens(Request $request,)
    {
        $ordens = OrdensDeServico::with('mecanicos')->with('bicicletas')->orderBy('id', 'DESC')->get();

        $user = $request->auth;

        return response()->json([
            'usuario' => $user,
            'sucesso' => true,
            'dados' => $ordens
        ], 200);
    }


    public function listarOrdemPorId(Request $request, $ordemId)
    {
        if (empty($ordemId)) {
            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Id da ordem não informado'
            ], 400);
        }

        $ordens = OrdensDeServico::with('mecanicos')->with('bicicletas')->where('id', $ordemId)->orderBy('id', 'DESC')->get();

        $user = $request->auth;


        return response()->json([
            'user' => $user,
            'sucesso' => true,
            'dados' => $ordens
        ], 200);
    }

    public function listarOrdensProprias(Request $request)
    {
        $usuarioLogado = $request->auth;
        $os = [];
        $bicicleta = [];
        $cliente = [];
        if ($usuarioLogado['perfil'] === 'mecanico') {
            $os = OrdensDeServico::where('mecanico_id', $usuarioLogado['id'])->first();
        }
        if ($usuarioLogado['perfil'] === 'cliente') {
            $cliente = Clientes::where('usuario_id', $usuarioLogado['id'])->first();
            $bicicleta = Bicicletas::where('cliente_id', $cliente->id)->first();
            $os = OrdensDeServico::where('bicicleta_id', $bicicleta->id)->first();
        }

        return response()->json([
            'sucesso' => true,
            'dados' => $os
        ], 200);
    }

    public function criarOrdem(Request $request)
    {
        try {
            $dadosValidados = $this->validate($request, OrdensDeServico::regras(), OrdensDeServico::mensagens());
            $dadosValidados['data_e_hora_abertura'] = Carbon::now()->format('Y-m-d H:i:s');
            $dadosValidados['status'] = 'aberta';
            $usuarioLogado = $request->auth;
            $dadosValidados['mecanico_id'] = $usuarioLogado['id'];

            $criar = OrdensDeServico::create($dadosValidados);

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Ordem de serviço criada com sucesso',
                'dados' => $criar
            ], 201);
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'chk_ordens_de_servico_status')) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Status da ordem de serviço fora do escopo: aberta, em_andamento ou concluida'
                ], 422);
            }

            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Erro ao tentar criar ordem de serviço'
            ], 500);
        }
    }

    public function atualizarOrdem(Request $request, $ordemId)
    {
        try {

            $os = OrdensDeServico::find($ordemId);

            if (empty($os)) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Ordem de serviço não encontrada'
                ], 404);
            }

            $dadosValidados = $this->validate($request, OrdensDeServico::regras(true), OrdensDeServico::mensagens());
            $dadosValidados['data_e_hora_abertura'] = Carbon::now()->format('Y-m-d H:i:s');

            
            $usuarioLogado = $request->auth;
            $dadosValidados['mecanico_id'] = $usuarioLogado['id'];


            $os->update($dadosValidados);

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Ordem de serviço atualizada com sucesso'
            ], 200);
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'chk_ordens_de_servico_status')) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Status da ordem de serviço fora do escopo: aberta, em_andamento ou concluida'
                ], 422);
            }

            return response()->json([
                'sucesso' => false,
                'mensagem' => 'Erro ao tentar atualizar ordem de serviço'
            ], 500);
        }
    }


    public function deletarOrdem($ordemId)
    {
        try {
            $os = OrdensDeServico::find($ordemId);

            if (empty($os)) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Ordem de serviço não encontrada'
                ], 404);
            }

            $os->delete();

            return response()->json([
                'sucesso' => true,
                'mensagem' => 'Ordem de serviço deletada com sucesso'
            ], 200);
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'ordens_de_servico_ibfk_2')) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Não é possível deletar uma ordem que tem uma bicicleta associada'
                ], 409);
            }
            if (str_contains($e->getMessage(), 'ordens_de_servico_ibfk_1')) {
                return response()->json([
                    'sucesso' => false,
                    'mensagem' => 'Não é possível deletar uma ordem que tem um mecânico associado'
                ], 409);
            }
        }
    }
}
