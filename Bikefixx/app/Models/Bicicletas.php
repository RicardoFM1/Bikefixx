<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bicicletas extends Model
{
    protected $table = 'bicicletas';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'marca_id',
        'cliente_id',
        'modelo',
        'aro'
    ];

    public function marcas()
    {
        return $this->belongsTo(Marcas::class, 'marca_id', 'id');
    }

    public function clientes()
    {
        return $this->belongsTo(Clientes::class, 'cliente_id', 'id');
    }

    public function ordens_de_servico()
    {
        return $this->hasMany(OrdensDeServico::class, 'bicicleta_id', 'id');
    }
}
