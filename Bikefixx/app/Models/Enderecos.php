<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'rua',
        'logradouro',
        'numero',
        'bairro',
        'cidade'
    ];

    public function clientes()
    {
        return $this->hasOne(Clientes::class, 'endereco_id', 'id');
    }
}
