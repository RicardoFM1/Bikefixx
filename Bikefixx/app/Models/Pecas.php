<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pecas extends Model
{
    protected $table = 'pecas';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'nome',
        'preco',
        'created_at',
        'updated_at'
    ];

    public function pecas_de_ordens_de_servico()
    {
        return $this->hasMany(PecasOrdensDeServico::class, 'peca_id', 'id');
    }

}
