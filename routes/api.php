<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ContactoSolicitadoController;

Route::apiResource('personas', PersonaController::class);
Route::apiResource('empresas', EmpresaController::class);
Route::apiResource('contactos', ContactoSolicitadoController::class);
