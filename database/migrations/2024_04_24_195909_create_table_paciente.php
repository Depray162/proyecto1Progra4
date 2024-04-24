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
        Schema::connection("mysql")-> create('paciente', function (Blueprint $table) {
            $table->integer("idPaciente")->autoincrement()->primary();
            $table->string("cedula",50)->nullable();
            $table->string("nombre",60)->nullable();
            $table->Integer("edad")->nullable();
            $table->string("direccion",100);
            $table->string("telefono",50);
            $table->string("email",120);
            

     
            
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
