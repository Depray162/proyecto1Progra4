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

        //Rutas de paciente
        Route::group(['prefix' => '/paciente'], function () {
            Route::post('/registerPac', [PacienteController::class, 'registerPac']);
            Route::post('/loginPac', [PacienteController::class, 'loginPac'])->withoutMiddleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
            Route::get('/{id}', [PacienteController::class, 'show'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
            Route::put('/{id}', [PacienteController::class, 'update'])->middleware([ApiAuthMiddlewarePac::class, ApiAuthMiddlewareVerifyPac::class]);
            Route::get('/cita/index', [CitaController::class, 'indexCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::post('/cita/agregar', [CitaController::class, 'store'])->middleware(ApiAuthMiddlewarePac::class);
            Route::get('/cita/{id}', [CitaController::class, 'showCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::put('/cita/actualizar/{id}', [CitaController::class, 'updateCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::delete('/cita/eliminar/{id}', [CitaController::class, 'destroyCitaPac'])->middleware(ApiAuthMiddlewarePac::class);
            Route::get('/verExpediente', [PacienteController::class, 'VerExpedienteP'])->middleware(ApiAuthMiddlewarePac::class);
        });

        //Rutas de medico
        Route::group(['prefix' => '/medico'], function () {
            Route::post('/registerMed', [MedicoController::class, 'registerMed']);
            Route::post('/loginMed', [MedicoController::class, 'loginMed'])->withoutMiddleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
            Route::get('/{id}', [MedicoController::class, 'show'])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
            Route::put('/{id}', [MedicoController::class, 'update'])->middleware([ApiAuthMiddlewareMed::class, ApiAuthMiddlewareVerifyMed::class]);
            Route::get('/cita/todas', [CitaController::class, 'indexCitaMed'])->middleware(ApiAuthMiddlewarePac::class);
            Route::get('/cita/{id}', [CitaController::class, 'showCitaMed'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/verCitas', [MedicoController::class, 'verCitas'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/expediente/index', [ExpedienteController::class, 'index'])->middleware(ApiAuthMiddlewarePac::class);
            Route::post('/expediente/agregar', [ExpedienteController::class, 'store'])->middleware(ApiAuthMiddlewareMed::class);
            Route::get('/expediente/{id}', [ExpedienteController::class, 'show'])->middleware(ApiAuthMiddlewareMed::class);
            Route::put('/expediente/actualizar/{id}', [ExpedienteController::class, 'update'])->middleware(ApiAuthMiddlewareMed::class);
            Route::delete('/expediente/actualizar/{id}', [ExpedienteController::class, 'delete'])->middleware(ApiAuthMiddlewareMed::class);
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
