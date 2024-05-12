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
        
        Schema::connection("mysql")->create('expediente', function (Blueprint $table) {
            $table->String("idExpediente")->primary();
            $table->string("tipoSangre", 3)->nullable();
            $table->string("alegia");
            $table->string("padecimiento");
            $table->string("medicamento");
      
        });

        
        DB::table('expediente')->insert([
            'idExpediente' => 'AB4567890',
            'tipoSangre' => 'A',
             'alegia' => 'Many',
            'padecimiento' => 'Calentura',
            'medicamento' => 'Bigvaporu',
            
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expediente');
    }
};
