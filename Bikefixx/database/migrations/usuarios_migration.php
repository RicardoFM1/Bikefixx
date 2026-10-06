<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


if (!Schema::hasTable('usuarios')) {

    Schema::create('usuarios', function (Blueprint $table) {
        $table->id();
        $table->string('nome', 150);
        $table->string('email', 150);
        $table->string('senha', 150);
        $table->enum('perfil', ['admin', 'cliente', 'mecanico']);
    });
}
