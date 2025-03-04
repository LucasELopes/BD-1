<?php

use App\Http\Controllers\LoteController;
use App\Http\Controllers\MoradorController;
use App\Http\Controllers\VacinaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rota moradores
Route::prefix('moradores')->group(function () {
    Route::get('/validarCpf/{cpf}', [MoradorController::class, 'validarCpf']);
    Route::post('/cadastrar-morador', [MoradorController::class, 'cadastrarMorador']);
});
Route::apiResource('/moradores', MoradorController::class)->except('store');

// Rotas vacinas
Route::post('/vacinas/registrar-vacina', [VacinaController::class, 'registrarVacina']);
Route::apiResource('/vacinas', VacinaController::class)->except('store');

// Rotas lotes
Route::prefix('lotes')->group(function () {
    Route::post('/registrar-entrada-vacina', [LoteController::class, 'registrarEntradaVacina']);
    Route::get('/emitir-relatorio-estoque', [LoteController::class, 'emitirRelatorioEstoque']);
    Route::get('/verificar-validade/{id}', [LoteController::class, 'verificar_validade']);
    Route::get('/excluir-lote-vencido', [LoteController::class, 'excluirLoteVencido']);
    Route::put('/registrar-saida-vacina', [LoteController::class, 'registrarSaidaVacina']);
});
Route::apiResource('/lotes', LoteController::class)->except('store', 'index');
