<?php

use App\Http\Controllers\Aparelho\AparelhoController;
use App\Http\Controllers\Auth\AuthCheckController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PermissaoController;
use App\Http\Controllers\Auth\UsuarioPermissaoController;
use App\Http\Controllers\Cidade\CidadeController;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Servicos\CalendarioController;
use App\Http\Controllers\Servicos\ItemOsEquipamentoController;
use App\Http\Controllers\Servicos\ItemOsServicoController;
use App\Http\Controllers\Servicos\OrdemServicoController;
use App\Http\Controllers\Servicos\ServicoController;
use App\Http\Controllers\Telefone\TelefoneController;
use App\Http\Controllers\TipoUsuario\TipoUsuarioController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Middleware\AuthToken;
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

Route::post("login", [AuthController::class, 'login']);
Route::get('auth-check', [AuthCheckController::class, 'check'])->name('auth.check');

Route::middleware(AuthToken::class)->group(function () {

    Route::post("logout", [AuthController::class, 'logout'])->name('logout.logout');

    Route::apiResource("usuario", UsuarioController::class);
    Route::apiResource('tipo-usuario', TipoUsuarioController::class);
    Route::apiResource("cliente", ClienteController::class);
    Route::apiResource("aparelho", AparelhoController::class);
    Route::apiResource("cidade", CidadeController::class);
    Route::apiResource("telefone", TelefoneController::class);
    Route::apiResource("ordem-servico", OrdemServicoController::class);
    Route::apiResource('item-os', ItemOsEquipamentoController::class);
    Route::apiResource("servico-os", ItemOsServicoController::class);
    Route::apiResource('permissao', PermissaoController::class);
    Route::apiResource('usuario-permissao', UsuarioPermissaoController::class);
    Route::apiResource('servico', ServicoController::class);
    Route::apiResource('calendario', CalendarioController::class);

});
