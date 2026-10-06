<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



if (!Schema::hasTable('enderecos')) {
    Schema::create('enderecos', function (Blueprint $table) {
        $table->id();
        $table->string('rua', 150);
        $table->string('logradouro', 150);
        $table->string('numero', 150);
        $table->string('bairro', 150);
        $table->string('cidade', 150);
    });
}
