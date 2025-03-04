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
            ->paginate((int) $request->per_page);

        return response()->json($morador, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cadastrarMorador(MoradorRequest $request): JsonResponse
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
    public function destroy(String $id): JsonResponse
    {
        $morador = $this->morador->findOrFail( $id );
        $morador->delete();

        return response()->json([], Response::HTTP_OK);
    }

    public function checar_historico(String $cpfMorador) {
        // Precisa do relacionameto com a tabela
    }

    public function validarCpf(String $cpf): JsonResponse
    {
        $cpfValido = false;
        $cpf = trim($cpf);

        if(strlen($cpf) == 11) {
            $valorTotal = 0;
            $cpfAux = array_reverse(
                array_slice(str_split(trim($cpf)),
                0,
                9
            ));

            for($i = 0; $i < 9; $i++) {
                $valorTotal += ((int)$cpfAux[$i]) * ($i+2);
            }

            $resto = 11 - ($valorTotal % 11);
            $cpfAux = array_merge_recursive( [$resto <= '1' ? '0' : "$resto"], $cpfAux);
            $valorTotal = 0;

            for($i = 0; $i < 10; $i++) {
                $valorTotal += ((int)$cpfAux[$i]) * ($i+2);
            }

            $resto = 11 - ($valorTotal % 11);
            $cpfAux = array_reverse(array_merge_recursive( [$resto <= '1' ? '0' : "$resto"], $cpfAux));

            $cpfValido = implode($cpfAux) == $cpf ?? true;
        }

        return response()->json($cpfValido, Response::HTTP_OK);
    }
}
