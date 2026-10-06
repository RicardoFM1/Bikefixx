<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!Schema::hasTable('bicicletas')) {
Schema::create('bicicletas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('marca_id')->constrained('marcas')->restrictOnDelete()->restrictOnUpdate();
    $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnDelete()->cascadeOnUpdate();
    $table->string('modelo', 150);
    $table->string('aro', 20);
});
}