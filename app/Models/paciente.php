<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paciente extends Model
{
    use HasFactory;

    protected $table = "paciente";

    protected $primaryKey = "idPaciente";
    public $timestamps = false;
    protected $fillable = [
    
        "idPaciente",
        "cedula",
        "nombre",
        "edad",
        "direccion",
        "telefono",
        "email",
        "contrasena" 
        

    ];

    public function expediente(){
        return $this->hasOne(Expediente::class, "PacienteID", "idPaciente");

    }
}
