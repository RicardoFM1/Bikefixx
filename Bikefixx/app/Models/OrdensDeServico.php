<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdensDeServico extends Model
{
    protected $table = 'ordens_de_servico';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'status',
        'data_e_hora_abertura',
        'data_e_hora_conclusao',
        'bicicleta_id',
        'mecanico_id'
    ];

    public static function regras($atualizando = false)
    {

        if ($atualizando) {
            return [
                'status' => 'sometimes',
                'data_e_hora_abertura' => 'sometimes',
                'bicicleta_id' => 'sometimes|integer'
            ];
        }

        return [
            'bicicleta_id' => 'required|integer'
        ];
    }

    public static function mensagens()
    {
        return [
            'bicicleta_id.required' => 'A referência da bicicleta é obrigatória',
            'bicicleta_id.integer' => 'A referência da bicicleta deve ser um número inteiro',
        ];
    }

    public function mecanicos()
    {
        return $this->belongsTo(Mecanicos::class, 'mecanico_id', 'id');
    }

    public function bicicletas()
    {
        return $this->belongsTo(Bicicletas::class, 'bicicleta_id', 'id');
    }
}
