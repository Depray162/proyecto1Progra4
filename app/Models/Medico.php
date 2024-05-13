<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = "medico";

    protected $primaryKey = "idMedico";
    public $timestamps = false;
    protected $fillable = [
    
        "idMedico",
        "numColegiado",
        "cedula",
        "nombre",
        "especialidad",
        "telefono",
        "email",
        "idCita",
    ];

    public function cita()
    {
        return $this->hasMany(cita::class, "idCita");   
    }
}
