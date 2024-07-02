<?php

use App\Http\Controllers\aparelho\AparelhoController;
use App\Http\Controllers\cidade\CidadeController;
use App\Http\Controllers\cliente\ClienteController;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\servicos\OrdemServicoController;
use App\Http\Controllers\telefone\TelefoneController;
use App\Http\Controllers\usuario\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::post("login", [LoginController::class, 'login']);
Route::post("logout", [LoginController::class, 'logout']);

Route::apiResource("aparelho", AparelhoController::class);
Route::apiResource("cidade", CidadeController::class);
Route::apiResource("cliente", ClienteController::class);
Route::apiResource("ordem-servico", OrdemServicoController::class);
Route::apiResource("TelefoneController", TelefoneController::class);
Route::apiResource("usuario", UsuarioController::class);
