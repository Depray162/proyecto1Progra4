<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection("mysql")->create("cita", function (Blueprint $table) {
            $table->integer("idCita")->autoIncrement()->primary();
            $table->text("motivo")->nullable();
            $table->string("area", 60)->nullable();
            $table->string("fechaSolicitud", 60);
            $table->string("fechaCita", 60);
            $table->string("horaCita", 60);
            $table->unsignedBigInteger("idPaciente")->nullable(false);
            $table->unsignedBigInteger("idMedico")->nullable(false);

            $table->foreign('idPaciente')->references('idPaciente')->on('paciente');
            $table->foreign('idMedico')->references('idMedico')->on('medico');
           
            
        });

        /*DB::table('cita')->insert([
            'motivo' => 'Dolor de cabeza',
            'area' => 'San Roque',
            'fechaSolicitud' => '12/05/2024',
            'fechaCita' => '19/05/2024',
            'horaCita' => '8:00 am',
            'idPaciente'=> 1,
            'idMedico'=> 1
        ]);*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita');
    }
};