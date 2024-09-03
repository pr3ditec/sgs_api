<?php

namespace App\Http\Controllers\Cliente;

use App\Enums\ResponseCode;
use App\Enums\ResponseStatus;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Cliente\AlterarClienteRequest;
use App\Http\Requests\Cliente\CriarClienteRequest;
use App\Models\Aparelho;
use App\Models\Cliente;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

    public function index()
    {
        try {

            $cliente = Cliente::getAllData('cliente');

            if ($cliente->isEmpty()) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'index-client-empty');
            }

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'index-client-success', $cliente);
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'index-client-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $cliente = Cliente::findOrFail($id);
            $pessoa_fisica = PessoaFisica::where("cliente_id", "=", $cliente->id)->get();
            $pessoa_juridica = PessoaJuridica::where("cliente_id", "=", $cliente->id)->get();
            $aparelhos = Aparelho::where("cliente_id", "=", $cliente->id)->get();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'show-client-success', [
                "cliente" => $cliente,
                "pessoa_juridica" => $pessoa_juridica ?? [],
                "pessoa_fisica" => $pessoa_fisica ?? [],
                "aparelhos" => $aparelhos,
            ]);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'client-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'show-user-error', $e->getMessage());
        }
    }

    public function store(CriarClienteRequest $request)
    {
        try {
            DB::beginTransaction();

            $cliente = Cliente::create([
                'nome' => strtoupper($request->nome),
                'logradouro' => strtoupper($request->logradouro),
                'cep' => $request->cep,
                'complemento' => strtoupper($request->complemento),
                'numero' => $request->numero,
                'cidade_id' => $request->cidade_id,
                'usuario_id' => $request->usuario_id,
            ]);

            if (isset($request->cpf)) {

                $pessoa_fisica = PessoaFisica::create([
                    "cpf" => $request->cpf,
                    "cliente_id" => $cliente->id,
                ]);

            } else {
                $pessoa_juridica = PessoaJuridica::create([
                    "cnpj" => $request->cnpj,
                    "inscricao_municipal" => $request->inscricao_municipal ?? null,
                    "inscricao_estadual" => $request->inscricao_estadual ?? null,
                    "cliente_id" => $cliente->id,
                ]);
            }

            DB::commit();
            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'store-client-success', [
                "cliente" => $cliente,
                "pessoa_fisica" => $pessoa_fisica ?? [],
                "pessoa_juridica" => $pessoa_juridica ?? [],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'store-client-error', $e->getMessage());
        }
    }

    public function update(AlterarClienteRequest $request, int $id)
    {
        try {

            if ($request->id != $id) {

                return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'update-data-corupted');
            }

            DB::beginTransaction();

            $cliente = Cliente::findOrFail($id);
            $cliente->update([
                'nome' => $request->nome ? strtoupper($request->nome) : $cliente->nome,
                'logradouro' => $request->logradouro ? strtoupper($request->logradouro) : $cliente->logradouro,
                'cep' => $request->cep ?? $cliente->cep,
                'complemento' => $request->complemento ? strtoupper($request->complemento) : $cliente->complemento,
                'numero' => $request->numero ?? $cliente->numero,
                'cidade_id' => $request->cidade_id ?? $cliente->cidade_id,
            ]);

            if (isset($request->cpf)) {

                $pessoa_fisica = PessoaFisica::where("cliente_id", "=", $cliente->id)->first();
                $pessoa_fisica->update(["cpf" => $request->cpf]);

            }
            if (isset($request->cnpj)) {
                $pessoa_juridica = PessoaJuridica::where("cliente_id", "=", $cliente->id)->first();
                $pessoa_juridica->update([
                    "cnpj" => $request->cnpj,
                    "inscricao_municipal" => $request->inscricao_municipal ?? $pessoa_juridica->inscricao_municipal,
                    "inscricao_estadual" => $request->inscricao_estadual ?? $pessoa_juridica->inscricao_estadual,
                ]);
            }

            DB::commit();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'update-client-success', $cliente);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'client-not-found');
        } catch (Exception $e) {
            DB::rollBack();

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'update-client-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return Response::send(ResponseCode::Ok, ResponseStatus::Success, 'destroy-client-success', $cliente);
        } catch (ModelNotFoundException $e) {

            return Response::send(ResponseCode::NotFound, ResponseStatus::Failed, 'client-not-found');
        } catch (Exception $e) {

            return Response::send(ResponseCode::BadRequest, ResponseStatus::Failed, 'destroy-client-error', $e->getMessage());
        }
    }
}
