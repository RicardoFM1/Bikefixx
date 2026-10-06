<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PecasOrdensDeServico extends Model
{
    protected $table = 'pecas_ordens_de_servico';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'peca_id',
        'ordem_de_servico_id',
        'quantidade',
        'preco_unitario',
        'preco_total'
    ];

    public function pecas (){
        return $this->belongsTo(Pecas::class, 'peca_id', 'id');
    }

    public function ordens_de_servico () {
        return $this->belongsTo(OrdensDeServico::class, 'ordem_de_servico', 'id');
    }
}
