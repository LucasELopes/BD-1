<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $postRules = [];
        $putRules = [];

        $rules = [
            'idLote'=> ['string', 'unique:lotes,idLote'],
            'idVacina'=> ['string', 'exists:vacinas,idVacina'],
            'validade'=> ['date'],
            'qtdRecebida' => ['numeric', 'min: 0'],
            'qtdDisponivel' => ['numeric', 'min: 0'],
        ];

        if($this->isMethod('post')) {
            $postRules = [
                'idVacina'=> ['required'],
                'idLote'=> ['required'],
                'validade'=> ['required'],
                'qtdRecebida' => ['required'],
                'qtdDisponivel' => ['required'],
            ];
        }

        if($this->isMethod('put')) {
            $putRules = [
                'idVacina'=> ['sometimes'],
                'idLote'=> ['sometimes'],
                'validade'=> ['sometimes'],
                'qtdRecebida' => ['sometimes'],
                'qtdDisponivel' => ['sometimes'],
            ];
        }

        return array_merge_recursive($rules, $postRules, $putRules);
    }

    public function messages(): array
    {
        return [
            'idLote.string' => 'O ID do lote deve ser um texto.',
            'idLote.unique' => 'Este ID de lote já está cadastrado.',

            'idVacina.string' => 'O ID da vacina deve ser um texto.',
            'idVacina.exists' => 'A vacina informada não existe no sistema.',

            'validade.date' => 'A validade deve ser uma data válida.',

            'qtdRecebida.numeric' => 'A quantidade original deve ser um número.',
            'qtdRecebida.min' => 'A quantidade original não pode ser negativa.',

            'qtdDisponivel.numeric' => 'A quantidade disponível deve ser um número.',
            'qtdDisponivel.min' => 'A quantidade disponível não pode ser negativa.',
        ];
    }

}
