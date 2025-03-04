<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoteRequest;
use App\Models\Lote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoteController extends Controller
{

    private $lote;

    public function __construct(Lote $lote) {
        $this->lote = $lote;
    }

    /**
     * Display a listing of the resource.
     */
    public function emitirRelatorioEstoque(Request $request): JsonResponse
    {
        $vacina = Lote::query()->with("vacina")
            ->when($request->has('idVacina'), fn ($query) => $query->orWhere('idVacina', 'like', "%{$request['idVacina']}%"))
            ->when($request->has('idLote'), fn ($query) => $query->orWhere('idLote', 'like', "%{$request['idLote']}%"))
            ->when($request->has('validade'), fn ($query) => $query->orWhere('validade', 'like', "%{$request['validade']}%"))
            ->when($request->has('dataEntrada'), fn ($query) => $query->orWhere('dataEntrada', 'like', "%{$request['dataEntrada']}%"))
            ->when($request->has('qtdOriginal'), fn ($query) => $query->orWhere('qtdOriginal', 'like', "%{$request['qtdOriginal']}%"))
            ->when($request->has(key: 'qtdDisponivel'), fn ($query) => $query->orWhere('qtdDisponivel', 'like', "%{$request['qtdDisponivel']}%"))
            ->paginate((int) $request->per_page);

            return response()->json($vacina, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registrarEntradaVacina(LoteRequest $request)
    {
        $data = $request->validated();
        $lote = $this->lote->create($data);

        return response()->json($lote, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $lote = $this->lote->where('idVacina', $id)->get();

        if ($lote->isEmpty()) {
            $lote = $this->lote->findOrFail($id);
        }

        return response()->json($lote, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LoteRequest $request, String $id)
    {
        $data = $request->validated();

        $lote = $this->lote->where('idVacina', $id)->get();
        if($lote->isEmpty()) {
            $lote = $this->lote->findOrFail($id);
        }
        $lote->update($data);

        return response()->json($lote, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $lotes = $this->lote->where('idVacina', $id)->get();
        if ($lotes->isEmpty()) {
            $lote = $this->lote->findOrFail($id);
            $lote->delete();
        }
        else {
            foreach ($lotes as $lote) {
                $lote->delete();
            }
        }

        return response()->json([], Response::HTTP_OK);
    }

    public function excluirLoteVencido() {
        $lotes = $this->lote->where('validade', '<', now())->get();
        if(!$lotes->isEmpty()) {
            foreach ($lotes as $lote) {
                $lote->delete();
            }
        }

        return response()->json($lotes, Response::HTTP_OK);
    }
}
