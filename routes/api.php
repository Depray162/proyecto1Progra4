<?php

use App\Http\Controllers\ExpedienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Models\Expediente;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group( 
    function(){
//Rutas expecificas

//rutas automaticas
Route::resource('/paciente',PacienteController::class, ['except'=> ['create', 'edit']]);
Route::resource('/expediente',ExpedienteController::class, ['except'=> ['create', 'edit']]);

    }  
);

