<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mecanicos extends Model
{
    protected $table = 'mecanicos';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'usuario_id',
        'carga_horaria',
        'salario'
    ];

    public function usuarios()
    {
        return $this->hasOne(Usuarios::class, 'id', 'usuario_id');
    }

    public function ordens_de_servico()
    {
        return $this->hasMany(OrdensDeServico::class, 'mecanico_id', 'id');
    }
}
