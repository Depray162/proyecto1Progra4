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

        // Insertar datos de ejemplo
        /*DB::table('paciente')->insert([
            'cedula' => '1234567890',
            'nombre' => 'Juan Perez',
            'edad' => 30,
            'direccion' => 'Calle 123, Ciudad ABC',
            'telefono' => '123456789',
            'email' => 'juan@example.com',
            'contrasena' => 'pedro123'
        ]);*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
