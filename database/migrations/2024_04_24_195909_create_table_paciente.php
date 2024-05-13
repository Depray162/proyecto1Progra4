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
            $table->id();
            $table->string("cedula", 50)->nullable()->unique();
            $table->string("nombre", 60)->nullable();
            $table->integer("edad")->nullable();
            $table->string("direccion", 100);
            $table->string("telefono", 50);
            $table->string("email", 120);
            $table->string("contrasena");
        });

        
        DB::table('paciente')->insert([
            'cedula' => '1234567890',
            'nombre' => 'Juan Perez',
            'edad' => 30,
            'direccion' => 'Calle 123, Ciudad ABC',
            'telefono' => '123456789',
            'email' => 'juan@example.com',
            'contrasena' => 'pedro123'
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
