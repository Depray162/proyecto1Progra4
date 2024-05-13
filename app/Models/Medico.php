<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = "medico";

    protected $primaryKey = "numColegiado";
    public $timestamps = false;
    protected $fillable = [
    
        "numColegiado",
        "cedula",
        "nombre",
        "especialidad",
        "telefono",
        "email" 
    ];

}
