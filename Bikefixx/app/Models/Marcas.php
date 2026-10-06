<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    protected $table = 'marcas';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public $fillable = [
        'nome'
    ];

    public function bicicletas()
    {
        return $this->hasMany(Bicicletas::class, 'marca_id', 'id');
    }
}
