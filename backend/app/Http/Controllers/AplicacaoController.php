<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplicacao;
use App\Http\Requests\AplicacaoRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AplicacaoController extends Controller
{
    private $aplicacao;

    public function __construct(Aplicacao $aplicacao)
    {
        $this->aplicacao = $aplicacao;
    }
    /**
     * Display a listing of the resource.
     */
public function index(Request $request): JsonResponse
{
    $aplicacoes = Aplicacao::query()
        ->when($request->has('cpfMorador'), fn ($query) => $query->where('cpfMorador', 'like', "%{$request['cpfMorador']}%"))

        ->when($request->has('idVacina'), fn ($query) => $query->where('idVacina', $request['idVacina']))

        ->when($request->has('idLote'), fn ($query) => $query->where('idLote', $request['idLote']))

        ->when($request->has('dataAplicacao'), fn ($query) => $query->whereDate('dataAplicacao', $request['dataAplicacao']))

        ->when($request->has('doseAplicada'), fn ($query) => $query->where('doseAplicada', $request['doseAplicada']))

        ->with(['morador', 'vacina', 'lote'])
        ->paginate((int) $request->per_page ?? 10);

    return response()->json($aplicacoes, Response::HTTP_OK);
}
    /**
     * Store a newly created resource in storage.
     */
    public function aplicarVacina(AplicacaoRequest $request)
    {

        $data = $request->validated();
        $aplicacao = $this->aplicacao->create($data);

        return response()->json([
            'message' => 'Vacina aplicada com sucesso!',
            'id' => $aplicacao->id,
            'data' => $aplicacao
        ], Response::HTTP_CREATED);

    }
    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $aplicacao = Aplicacao::find($id);

        if (!$aplicacao){
            return response()->json(['message' => 'Aplicação não encontrada'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($aplicacao, Response::HTTP_OK);
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(AplicacaoRequest $request, $id): JsonResponse
    {
        $aplicacao = Aplicacao::find($id);

        if (!$aplicacao) {
            return response()->json(['message' => 'Aplicação não encontrada'], Response::HTTP_NOT_FOUND);
        }

        $aplicacao->update($request->validated());

        return response()->json([
            'message' => 'Aplicação de vacina atualizada com sucesso!',
            'data'    => $aplicacao
        ], Response::HTTP_OK);
    }

        /**
         * Remove the specified resource from storage.
         */
   
    public function destroy($id): JsonResponse
    {
        $aplicacao = Aplicacao::find($id);

        if (!$aplicacao) {
            return response()->json(['message' => 'Aplicação não encontrada'], Response::HTTP_NOT_FOUND);
        }

        $aplicacao->delete();

        return response()->json(['message' => 'Aplicação de vacina removida com sucesso!'], Response::HTTP_NO_CONTENT);
    }


}
