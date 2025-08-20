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

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('correo', 255)->primary();
            $table->string('token', 255);
            $table->timestamp('created_at')->nullable()->default('DEFAULT NULL');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
