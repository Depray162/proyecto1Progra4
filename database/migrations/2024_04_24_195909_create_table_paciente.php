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
        
        Schema::connection("mysql")->create('paciente', function (Blueprint $table) {
            $table->integer("idPaciente")->autoIncrement()->primary();
            $table->string("cedula", 50)->nullable();
            $table->string("nombre", 60)->nullable();
            $table->integer("edad")->nullable();
            $table->string("direccion", 100);
            $table->string("telefono", 50);
            $table->string("email", 120);
        });

        
        DB::table('paciente')->insert([
            'cedula' => '1234567890',
            'nombre' => 'Juan Perez',
            'edad' => 30,
            'direccion' => 'Calle 123, Ciudad ABC',
            'telefono' => '123456789',
            'email' => 'juan@example.com',
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
