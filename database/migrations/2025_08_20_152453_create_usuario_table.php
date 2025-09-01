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

        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('padre');
            $table->string('primer_nombre', 20);
            $table->string('segundo_nombre', 20);
            $table->string('primer_apellido', 20);
            $table->string('segundo_apellido', 20);
            $table->string('correo', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 225);
            $table->string('remember_token', 100)->nullable();
            $table->tinyInteger('estado');
            $table->unsignedInteger('id_rol')->index();
            $table->foreign('id_rol')->references('id_rol')->on('rol');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
