<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!Schema::hasTable('pecas_ordens_de_servico')) {
    Schema::create('pecas_ordens_de_servico', function (Blueprint $table) {
        $table->id();
        $table->enum('status', ['aberta', 'em_andamento', 'concluida']);
        $table->integer('quantidade');
        $table->integer('preco_unitario');
        $table->integer('preco_total');
        $table->foreignId('peca_id')->constrained('pecas')->restrictOnDelete()->restrictOnDelete();
        $table->foreignId('ordem_de_servico_id')->constrained('ordem_de_servico')->cascadeOnDelete()->cascadeOnUpdate();
    });
}
