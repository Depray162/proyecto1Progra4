<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita extends Model
{
    use HasFactory;

    protected $table = "cita";

    protected $primaryKey = "idCita";

    public $timestamps = false;


    protected $fillable = [

        "idCita",
        "motivo",
        "area",
        "fechaSolicitud",
        "fechaCita",
        "horaCita",
        "idPaciente",
        "idMedico"
    ];

    public function paciente()
    {
        return $this->belongsTo(paciente::class, 'idPaciente');
    }

    public function medico()
    {
        return $this->belongsTo("medico::class", 'idMedico');
    }
}
