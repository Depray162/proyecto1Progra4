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
        /**
         * Run the migrations.
         */
        
        
            Schema::create('expediente', function (Blueprint $table) {
                $table->id('idExpediente');
                $table->string("tipoSangre", 3)->nullable(false);
                $table->text("alergia")->nullable(false);
                $table->text("padecimiento")->nullable(false);
                $table->text("medicamento")->nullable(false);
                $table->unsignedBigInteger('PacienteID')->unique();
                

                $table->foreign('PacienteID')->references('idPaciente')->on('paciente');
                
                
                
            });
            /*DB::table('expediente')->insert([
                'tipoSangre' => 'A',
                'alergia' => 'Many',
                'padecimiento' => 'Calentura',
                'medicamento' => 'Bigvaporu',
                'PacienteID' => 1,
                
            ]);*/
          
        }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('expediente');
        }
};
