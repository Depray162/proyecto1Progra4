<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
   use HasFactory;

    protected $table = "Expediente";

    protected $primaryKey = "idExpediente";
    public $timestamps = false;
    protected $fillable = [
    
        "idExpediente",
        "tipoSangre",
        "alegia",
        "padecimiento",
        "medicamento",        
        "PacienteID"
    ];

    public function paciente(){
        return $this->belongsTo(paciente::class,"PacienteID");
    }

}
