<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Middleware\ApiAuthMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(
    function () {
        //Rutas expecificas
        Route::post('/paciente/login', [PacienteController::class, 'login']);

        //rutas automaticas
        Route::resource('/paciente', PacienteController::class, ['except' => ['create', 'edit','login']])->middleware(ApiAuthMiddleware::class);
        Route::resource('/medico', MedicoController::class, ['Except' => ['create', 'edit']]);
        Route::resource('/cita', CitaController::class, ['Except' => ['create', 'edit']]);
        Route::resource('/historial', HistorialController::class, ['Except' => ['create', 'edit']]);
        route::resource('/expediente', ExpedienteController::class, ['Except' => ['create', 'edit']]);
    }
);
