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

    public function mecanicos()
    {
        return $this->belongsTo(Mecanicos::class, 'mecanico_id', 'id');
    }

    public function bicicletas()
    {
        return $this->belongsTo(Bicicletas::class, 'bicicleta_id', 'id');
    }
}
