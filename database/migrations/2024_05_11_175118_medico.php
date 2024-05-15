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
  
       /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medico', function (Blueprint $table) {
            $table->id('idMedico'); // Utilizamos el método id() para definir la columna autoincremental y clave primaria
            $table->integer('numColegiado')->unique(); // Usamos unique() para hacer que esta columna sea única pero no autoincremental
            $table->string('cedula', 12)->nullable();
            $table->text('nombre')->nullable();
            $table->string('especialidad', 60)->nullable();

            $table->string('telefono', 12);
            $table->text('email');
           $table->string('contrasena',12)->nullable();
          
            
        });

        /*DB::table('medico')->insert([
            'numColegiado' => '1558',
            'cedula' => '504350769',
            'nombre' => 'Kevin Salazar Bravo',
            'especialidad' => 'Oncologia',
            'telefono' => '123456789',
            'email' => 'kevin@example.com',
            'contrasena'=> 'ickkck'
        ]);*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico');
    }

};
