<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Models\paciente;
use App\Http\Controllers\MedicoController;
use App\Models\Medico;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group( 
    function(){
//Rutas expecificas

//rutas automaticas
Route::resource('/paciente',PacienteController::class);
Route::resource('/medico',MedicoController::class);
    } 
);
   



