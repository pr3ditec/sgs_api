<?php

namespace App\Http\Controllers\Aparelho;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Response;
use App\Http\Requests\Aparelho\AlterarAparelhoRequest;
use App\Http\Requests\Aparelho\CriarAparelhoRequest;
use App\Models\Aparelho;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AparelhoController extends Controller
{
    public function index()
    {
        try {

            $aparelho = Aparelho::getAll('aparelho');

            if ($aparelho->isEmpty()) {

                return Response::send(404, false, 'index-device-empty');
            }

            return Response::send(200, true, 'index-device-success', $aparelho);

        } catch (Exception $e) {

            return Response::send(400, false, 'index-device-error', $e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {

            $aparelho = Aparelho::findOrFail($id);

            return Response::send(200, true, 'show-device-success', $aparelho);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'device-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'show-device-error', $e->getMessage());
        }
    }

    public function store(CriarAparelhoRequest $request)
    {
        try {

            $aparelho = Aparelho::create([
                "nome" => strtoupper($request->nome),
                "tipo" => strtoupper($request->tipo),
                "cliente_id" => $request->cliente_id,
            ]);

            return Response::send(200, true, 'store-device-success', $aparelho);
        } catch (Exception $e) {

            return Response::send(400, false, 'store-device-error', $e->getMessage());
        }
    }

    public function update(AlterarAparelhoRequest $request, int $id)
    {
        try {

            $aparelho = Aparelho::findOrFail($id);
            $aparelho->update([
                "nome" => $request->nome ? strtoupper($request->nome) : $aparelho->nome,
                "tipo" => $request->tipo ? strtoupper($request->tipo) : $aparelho->tipo,
                "cliente_id" => $request->cliente_id ?? $aparelho->cliente_id,
            ]);

            return Response::send(200, true, 'update-device-success', $aparelho);

        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'device-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'update-device-error', $e->getMessage());
        }
    }

    public function destroy(int $id)
    {
        try {
            $aparelho = Aparelho::findOrFail($id);
            $aparelho->delete();

            return Response::send(200, true, 'destroy-device-success', $aparelho);
        } catch (ModelNotFoundException $e) {
            return Response::send(404, false, 'device-not-found');
        } catch (Exception $e) {
            return Response::send(400, false, 'destroy-device-error', $e->getMessage());
        }
    }
}
