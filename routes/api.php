<?php

use App\Http\Controllers\CitaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(
    function () {
        //Rutas expecificas

        //rutas automaticas
        Route::resource('/paciente', PacienteController::class, ['except' => ['create', 'edit']]);
        Route::resource('/medico', MedicoController::class, ['Except' => ['create', 'edit']]);
        Route::resource('/cita', CitaController::class, ['Except' => ['create', 'edit']]);
        Route::resource('/historial', HistorialController::class, ['Except' => ['create', 'edit']]);
        route::resource('/expediente', ExpedienteController::class, ['Except' => ['create', 'edit']]);
    }
);
