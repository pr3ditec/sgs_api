<?php

use App\Http\Controllers\Aparelho\AparelhoController;
use App\Http\Controllers\Cidade\CidadeController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Servicos\OrdemServicoController;
use App\Http\Controllers\Telefone\TelefoneController;
use App\Http\Controllers\Usuario\UsuarioController;
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
Route::apiResource("telefone", TelefoneController::class);
Route::apiResource("usuario", UsuarioController::class);
