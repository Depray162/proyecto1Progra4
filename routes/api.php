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

Route::prefix('v1')->group(
    function () {
        //Rutas expecificas

        //Rutas de paciente
        Route::group(['prefix' => '/paciente'], function () {
            Route::post('/registerPac', [PacienteController::class, 'registerPac']);
            Route::post('/loginPac', [PacienteController::class, 'loginPac'])->withoutMiddleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
            Route::get('/{id}', [PacienteController::class, 'show'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
            Route::put('/actualizar/{id}', [PacienteController::class, 'update'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
            Route::get('/cita/indexPac', [CitaController::class, 'indexCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::post('/cita/agregarPac', [CitaController::class, 'storeCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::get('/cita/{id}', [CitaController::class, 'showCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::put('/cita/actualizar/{id}', [CitaController::class, 'updateCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::delete('/cita/eliminar/{id}', [CitaController::class, 'destroyCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::get('/expediente/indexPac', [ExpedienteController::class, 'showExpedientePac'])->middleware(ApiAuthMiddlewarePac::class);
        });

        //Rutas de medico
        Route::group(['prefix' => '/medico'], function () {
            Route::post('/registerMed', [MedicoController::class, 'registerMed']);
            Route::post('/loginMed', [MedicoController::class, 'loginMed'])->withoutMiddleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
            Route::get('/{id}', [MedicoController::class, 'show'])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
            Route::put('/actualizar/{id}', [MedicoController::class, 'update'])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
            Route::get('/cita/indexMed', [CitaController::class, 'indexCitaMed'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/cita/{id}', [CitaController::class, 'showCitaMed'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/expediente/indexMed', [ExpedienteController::class, 'index'])->middleware(ApiAuthMiddlewareMed::class);
            Route::post('/expediente/agregarMed', [ExpedienteController::class, 'store'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/expediente/{id}', [ExpedienteController::class, 'show'])->middleware(ApiAuthMiddlewareMed::class);
            Route::put('/expediente/actualizar/{id}', [ExpedienteController::class, 'update'])->middleware(ApiAuthMiddlewareMed::class);
            Route::delete('/expediente/eliminar/{id}', [ExpedienteController::class, 'destroy'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/historial/indexMed', [HistorialController::class, 'index'])->middleware(ApiAuthMiddlewareMed::class);
            Route::post('/historial/agregarMed', [HistorialController::class, 'store'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/historial/{id}', [HistorialController::class, 'show'])->middleware(ApiAuthMiddlewareMed::class);
            Route::put('/historial/actualizar/{id}', [HistorialController::class, 'update'])->middleware(ApiAuthMiddlewareMed::class);
            Route::delete('/historial/eliminar/{id}', [HistorialController::class, 'destroy'])->middleware(ApiAuthMiddlewareMed::class);
        });

        //Rutas administrador Eddier (el mejor)
        Route::group(['prefix' => '/administrador'], function () {
            Route::resource('/paciente', PacienteController::class, ['except' => ['create', 'edit']]);
            Route::resource('/medico', MedicoController::class, ['Except' => ['create', 'edit']]);
            Route::resource('/cita', CitaController::class, ['Except' => ['create', 'edit']]);
            Route::resource('/historial', HistorialController::class, ['Except' => ['create', 'edit']]);
            route::resource('/expediente', ExpedienteController::class, ['Except' => ['create', 'edit']]);
        });

        //Rutas automaticas
    }
);
