<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('registro_pagos', function (Blueprint $table) {
            $table->increments('id_registro');
            $table->string('descripcion', 100);
            $table->decimal('total');
            $table->date('fecha');
            $table->string('lugar', 50);
            $table->unsignedInteger('id_alumno')->index();
            $table->foreign('id_alumno')->references('id_alumno')->on('alumno');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_pagos');
    }
};
