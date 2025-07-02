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

        Schema::create('alumno', function (Blueprint $table) {
            $table->increments('id_alumno');
            $table->foreign('id_alumno')->references('id_alumno')->on('padre');
            $table->string('nombres', 50);
            $table->string('apellidos', 50);
            $table->integer('id_seccion')->unique();
            $table->foreign('id_seccion')->references('id_seccion')->on('seccion');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
