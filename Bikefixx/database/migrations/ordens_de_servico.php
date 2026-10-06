<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
if (!Schema::hasTable('ordens_de_servico')) {
Schema::create('ordens_de_servico', function (Blueprint $table) {
    $table->id();
    $table->enum('status', ['aberta', 'em_andamento', 'concluida']);
    $table->dateTime('data_e_hora_abertura')->useCurrent();
    $table->dateTime('data_e_hora_conclusao')->nullable();
    $table->foreignId('bicicleta_id')->constrained('bicicletas')->noActionOnDelete()->noActionOnUpdate();
    $table->foreignId('mecanico_id')->constrained('mecanicos')->noActionOnDelete()->noActionOnUpdate();
}); 
}