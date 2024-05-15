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

        Schema::create('paciente', function (Blueprint $table) {
            $table->id('idPaciente');
            $table->string("cedula", 12)->nullable(false)->unique();
            $table->string("nombre", 60)->nullable(false);
            $table->integer("edad")->nullable(false);
            $table->text("direccion");
            $table->string("telefono", 12);
            $table->text("email")->nullable(false);
            $table->string("contrasena")->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
