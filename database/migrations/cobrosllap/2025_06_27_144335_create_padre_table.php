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

        Schema::create('padre', function (Blueprint $table) {
            $table->increments('id_padres');
            $table->integer('id_usuario')->unique()->nullable();
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');
            $table->integer('id_alumno')->unique()->nullable();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padre');
    }
};
