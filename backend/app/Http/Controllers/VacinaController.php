<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacinaRequest;
use App\Models\Vacina;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VacinaController extends Controller
{

    private  $vacina;

    public function __construct(Vacina $vacina) {
        $this->vacina = $vacina;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $vacina = Vacina::query()
        ->when($request->has('idVacina'), fn ($query) => $query->orWhere('idVacina', 'like', "%{$request['idVacina']}%"))
        ->when($request->has('fabricante'), fn ($query) => $query->orWhere('fabricante', 'like', "%{$request['fabricante']}%"))
        ->when($request->has('nomeVacina'), fn ($query) => $query->orWhere('nomeVacina', 'like', "%{$request['nomeVacina']}%"))
        ->when($request->has('qtdDoses'), fn ($query) => $query->orWhere('qtdDoses', 'like', "%{$request['qtdDoses']}%"))
        ->paginate((int) $request->per_page);

    return response()->json($vacina, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registrarVacina(VacinaRequest $request)
    {
        $data = $request->validated();
        $vacina = $this->vacina->create($data);

        return response()->json($vacina, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $vacina = $this->vacina->findOrFail($id);
        return response()->json($vacina, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VacinaRequest $request, String $id)
    {
        $data = $request->validated();
        $vacina = $this->vacina->findOrFail($id);
        $vacina->update($data);

        return response()->json($vacina, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $vacina = $this->vacina->findOrFail($id);
        $vacina->delete();

        return response()->json([], Response::HTTP_OK);
    }
}
