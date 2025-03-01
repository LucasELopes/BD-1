<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacinaRequest extends FormRequest
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
            'idVacina' => ['string', 'min:6', 'max:6'],
            'fabricante' => ['string', 'max:100'],
            'nomeVacina' => ['string', 'max:100'],
            'qtdDoses' => ['numeric', 'min:0'],
        ];

        if($this->isMethod('post')) {
            $postRules = [
                'idVacina' => ['required'],
            ];
        }

        if($this->isMethod('put')) {
            $postRules = [
                'idVacina' => ['sometimes'],
            ];
        }

        return array_merge_recursive($rules, $postRules, $putRules);
    }

    public function messages(): array
    {
        return [
            'idVacina.required' => 'O campo ID da vacina é obrigatório.',
            'idVacina.string' => 'O campo ID da vacina deve ser uma string.',
            'idVacina.min' => 'O campo ID da vacina deve ter exatamente 6 caracteres.',
            'idVacina.max' => 'O campo ID da vacina deve ter exatamente 6 caracteres.',

            'fabricante.string' => 'O fabricante deve ser uma string.',
            'fabricante.max' => 'O fabricante pode ter no máximo 100 caracteres.',

            'nomeVacina.string' => 'O nome da vacina deve ser uma string.',
            'nomeVacina.max' => 'O nome da vacina pode ter no máximo 100 caracteres.',

            'qtdDoses.numeric' => 'A quantidade de doses deve ser um número.',
            'qtdDoses.min' => 'A quantidade de doses não pode ser negativa.',
        ];
    }

}
