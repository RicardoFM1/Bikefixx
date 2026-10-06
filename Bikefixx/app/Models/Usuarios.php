<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'nome',
        'email',
        'senha',
        'perfil',
        'token'
    ];

    public function clientes()
    {
        return $this->hasOne(Clientes::class, 'usuario_id', 'id');
    }

    public function mecanicos()
    {
        return $this->hasOne(Mecanicos::class, 'usuario_id', 'id');
    }
}
