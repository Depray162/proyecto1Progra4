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
        Schema::connection("mysql")->create('medico', function (Blueprint $table) {
            $table->integer("numColegiado", 20)->primary();
            $table->string("cedula", 50)->nullable();
            $table->string("nombre", 60)->nullable();
            $table->string("especialidad", 60)->nullable();
            $table->string("telefono", 50);
            $table->string("email", 120);
        });

        DB::table('medico')->insert([
            'numColegiado' => '1558',
            'cedula' => '504350769',
            'nombre' => 'Kevin Salazar Bravo',
            'especialidad' => 'Oncologia',
            'telefono' => '123456789',
            'email' => 'kevin@example.com',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico');
    }
};
