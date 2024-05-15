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
        Route::get('/paciente/cita/{id}', [CitaController::class, 'indexPacCita'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::get('/paciente/cita/{id}', [CitaController::class, 'storePacCita'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::get('/paciente/cita/{id}', [CitaController::class, 'showPacCita'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::get('/paciente/cita/{id}', [CitaController::class, 'updatePacCita'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::get('/paciente/cita/{id}', [CitaController::class, 'deletePacCita'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);

        Route::post('/medico/loginMed', [MedicoController::class, 'loginMed']);

        //rutas del paciente
        Route::get('/paciente/VerExpediente/', [PacienteController::class,'VerExpedienteP'])->middleware(ApiAuthMiddlewarePac::class);

       //ruta de medico/verCitas
       Route::get('/medico/verCitas', [MedicoController::class, 'verCitas'])->middleware(ApiAuthMiddlewareMed::class);

        //rutas automaticas
        Route::resource('/paciente', PacienteController::class, ['except' => ['create', 'edit', 'show', 'update', 'login', 'registerPac']])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
        Route::resource('/medico', MedicoController::class, ['Except' => ['create', 'edit', 'loginMed']])->middleware(ApiAuthMiddlewareMed::class);

        Route::resource('/cita', CitaController::class, ['Except' => ['create', 'edit']]);
        Route::resource('/historial', HistorialController::class, ['Except' => ['create', 'edit']]);
        route::resource('/expediente', ExpedienteController::class, ['Except' => ['create', 'edit']]);

        Route::resource('/cita', CitaController::class, ['Except' => ['create', 'edit','loginMed']])->middleware(ApiAuthMiddlewareMed::class);
        //Route::resource('/historial', HistorialController::class, ['Except' => ['create', 'edit']]);
       // route::resource('/expediente', ExpedienteController::class, ['Except' => ['create', 'edit']]);

    }
);
