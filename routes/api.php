<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Middleware\ApiAuthMiddlewarePac;
use App\Http\Middleware\ApiAuthMiddlewareMed;
use App\Http\Middleware\ApiAuthMiddlewareVerifyPac;
use App\Http\Middleware\ApiAuthMiddlewareVerifyMed;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(
    function () {
        //Rutas expecificas
        Route::post('/paciente/registerPac', [PacienteController::class, 'registerPac']);
        Route::post('/paciente/login', [PacienteController::class, 'login'])->withoutMiddleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::get('/paciente/{id}', [PacienteController::class,'show'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::put('/paciente/{id}', [PacienteController::class,'update'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::post('/medico/registerMed', [MedicoController::class,'registerMed']);
        Route::post('/medico/loginMed', [MedicoController::class, 'loginMed'])->withoutMiddleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
        Route::get('/medico/{id}', [MedicoController::class,'show'])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
        Route::put('/medico/{id}', [MedicoController::class,'update'])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);

        //rutas del paciente
        Route::get('/paciente/VerExpediente/', [PacienteController::class,'VerExpedienteP'])->middleware(ApiAuthMiddlewarePac::class);

       //ruta de medico/verCitas
       Route::get('/medico/verCitas', [MedicoController::class, 'verCitas'])->middleware(ApiAuthMiddlewareMed::class);

        //rutas automaticas
        Route::resource('/paciente', PacienteController::class, ['except' => ['create', 'edit', 'show', 'update', 'login', 'registerPac']])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::resource('/medico', MedicoController::class, ['Except' => ['create', 'edit', 'show', 'update', 'loginMed', 'registerMed']])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
        Route::resource('/cita', CitaController::class, ['Except' => ['create', 'edit']])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class, ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
        Route::resource('/historial', HistorialController::class, ['Except' => ['create', 'edit']])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
        route::resource('/expediente', ExpedienteController::class, ['Except' => ['create', 'edit']])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
    }
);
