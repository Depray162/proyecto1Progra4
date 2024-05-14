<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection("mysql")->create('historial', function (Blueprint $table) {
            $table->integer("idHistorial")->autoIncrement()->primary();
            $table->string("hora", 5)->nullable();
            $table->string("presionArterial", 10)->nullable();
            $table->float("peso")->nullable();
            $table->float("altura")->nullable();
            $table->float("temperatura")->nullable();
            $table->text("diagnostico")->nullable();
            $table->integer("idCita")->unique()->nullable(false);
            $table->unsignedBigInteger("idExpediente")->nullable(false);

            $table->foreign('idCita')->references('idCita')->on('cita');

            $table->foreign('idExpediente')->references('idExpediente')->on('expediente');


        });

        DB::table('historial')->insert([
            'hora' => '15:30',
            'presionArterial' => '120/80',
            'peso' => 65.5,
            'altura' => 170.80,
            'temperatura' => 35,
            'diagnostico' => 'no presenta ninguna circunstancia anomala',
            'idCita' => 1,
            'idExpediente' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial');
    }
};
