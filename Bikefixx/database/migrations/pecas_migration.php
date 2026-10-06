<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!Schema::hasTable('pecas')) {
Schema::create('pecas', function (Blueprint $table) {
    $table->id();
    $table->string('nome', 150);
    $table->integer('preco')->check;
    $table->dateTime('criado_em')->default('CURRENT_TIMESTAMP');
    $table->dateTime('atualizado_em')->default('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
});
}