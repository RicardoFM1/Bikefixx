<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
if (!Schema::hasTable('mecanicos')) {
Schema::create('mecanicos', function (Blueprint $table) {
    $table->id();
    $table->integer('salario');
    $table->integer('carga_horaria');
    $table->foreignId('usuario_id')->constrained('usuarios')->noActionOnDelete()->noActionOnUpdate();
});
}