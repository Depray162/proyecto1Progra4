<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;
Route::resource("paciente",PacienteController::class)->except(['create','edit','update']);    