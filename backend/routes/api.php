<?php

use App\Http\Controllers\MoradorController;
use App\Http\Controllers\VacinaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('/moradores', MoradorController::class);
Route::get('/moradores/validarCpf/{cpf}', [MoradorController::class, 'validarCpf']);

Route::apiResource('/vacinas', VacinaController::class)->except('store');
Route::post('/vacinas/registrar-vacina', [VacinaController::class, 'registrarVacina']);
