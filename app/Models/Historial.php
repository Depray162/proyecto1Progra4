<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = "historial";

    protected $primaryKey = "idHistorial";
    public $timestamps = false;
    protected $fillable = [
    
        "idHistorial",
        "hora",
        "presionArterial",
        "peso",
        "altura",
        "temperatura",
        "diagnostico" 
    ];
}
