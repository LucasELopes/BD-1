<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoradorRequest;
use App\Http\Requests\StoreMoradorRequest;
use App\Http\Requests\UpdateMoradorRequest;
use App\Models\Morador;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoradorController extends Controller
{

    private $morador;

    public function __construct(Morador $morador) {
        $this->morador = $morador;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $morador = Morador::query()
            ->when($request->has('cpfMorador'), fn ($query) => $query->orWhere('cpfMorador', 'like', "%{$request['cpfMorador']}%"))
            ->when($request->has('nmrSUS'), fn ($query) => $query->orWhere('nmrSUS', 'like', "%{$request['nmrSUS']}%"))
            ->when($request->has('nomeMorador'), fn ($query) => $query->orWhere('nomeMorador', 'like', "%{$request['nomeMorador']}%"))
            ->when($request->has('nomeMae'), fn ($query) => $query->orWhere('nomeMae', 'like', "%{$request['nomeMae']}%"))
            ->when($request->has('dataNascimento'), fn ($query) => $query->orWhere('dataNascimento', 'like', "%{$request['dataNascimento']}%"))
            ->when($request->has('sexo'), fn ($query) => $query->orWhere('sexo', 'like', "%{$request['sexo']}%"))
            ->when($request->has('endereco'), fn ($query) => $query->orWhere('endereco', 'like', "%{$request['endereco']}%"))
            ->when($request->has('estadoCivil'), fn ($query) => $query->orWhere('estadoCivil', 'like', "%{$request['estadoCivil']}%"))
            ->when($request->has('escolaridade'), fn ($query) => $query->orWhere('escolaridade', 'like', "%{$request['escolaridade']}%"))
            ->when($request->has('etnia'), fn ($query) => $query->orWhere('etnia', 'like', "%{$request['etnia']}%"))
            ->when($request->has('planoSaude'), fn ($query) => $query->orWhere('planoSaude', 'like', "%{$request['planoSaude']}%"))
            ->orderBy('created_at', 'desc')
            ->paginate((int) $request->per_page);

        return response()->json($morador, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MoradorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $morador = $this->morador->create($data);

        return response()->json($morador, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $cpfMorador): JsonResponse
    {
        $morador = $this->morador->findOrFail($cpfMorador);
        return response()->json($morador, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MoradorRequest $request, String $cpfMorador): JsonResponse
    {
        $data = $request->validated();
        $morador = $this->morador->findOrFail($cpfMorador);
        $morador->update($data);

        return response()->json($morador, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $morador = $this->morador->findOrFail( $id );
        $morador->delete();

        return response()->json([], Response::HTTP_OK);
    }
}
