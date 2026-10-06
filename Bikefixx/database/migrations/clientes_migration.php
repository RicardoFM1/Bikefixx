<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
if (!Schema::hasTable('clientes')) {
Schema::create('clientes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('usuario_id')->constrained('usuarios')->noActionOnDelete()->noActionOnUpdate();
    $table->date('data_de_nascimento');
    $table->foreignId('endereco_id')->constrained('enderecos')->noActionOnDelete()->noActionOnUpdate();
});
}