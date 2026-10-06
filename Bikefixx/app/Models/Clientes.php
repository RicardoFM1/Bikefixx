<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'usuario_id',
        'data_de_nascimento',
        'endereco_id'
    ];

    public function enderecos (){
        return $this->hasOne(Enderecos::class, 'endereco_id', 'id');
    }

    public function usuarios (){
        return $this->hasOne(Usuarios::class, 'usuario_id', 'id');
    }

    public function bicicletas (){
        return $this->hasMany(Bicicletas::class, 'cliente_id', 'id');
    }
}
