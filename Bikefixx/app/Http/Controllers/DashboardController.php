<?php

namespace App\Http\Controllers;

use App\Models\Mecanicos;
use App\Models\OrdensDeServico;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller;

class DashboardController extends Controller
{

    public function retornar()
    {
        $os = OrdensDeServico::with('mecanicos')->select('status', DB::raw('COUNT(*) AS total'))
            ->groupBy('status')
            ->get();

            $mecanicos = Mecanicos::with('usuarios')->get();


        return response()->json([
            'sucesso' => true,
            'dados' => $os,
            'mecanicos' => $mecanicos
        ], 200);
    }
}
