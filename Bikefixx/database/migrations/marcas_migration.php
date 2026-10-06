<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
if (!Schema::hasTable('marcas')) {
Schema::create('marcas', function (Blueprint $table) {
    $table->id();
    $table->string('nome', 150);
});
}