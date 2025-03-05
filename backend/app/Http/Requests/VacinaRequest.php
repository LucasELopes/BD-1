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
            'idVacina' => ['string', 'unique:vacinas,idVacina', 'min:15', 'max:15'],
            'fabricante' => ['string', 'max:15'],
            'nomeVacina' => ['string', 'max:20'],
            'qtdDoses' => ['numeric', 'min:0'],
        ];

        if($this->isMethod('post')) {
            $postRules = [
                'idVacina' => ['required'],
                'fabricante' => ['required'],
                'nomeVacina' => ['required'],
                'qtdDoses' => ['required'],
            ];
        }

        if($this->isMethod('put')) {
            $putRules = [
                'idVacina' => ['sometimes'],
                'fabricante' => ['sometimes'],
                'nomeVacina' => ['sometimes'],
                'qtdDoses' => ['sometimes'],
            ];
        }

        return array_merge_recursive($rules, $postRules, $putRules);
    }

    public function messages(): array
    {
        return [
            'idVacina.required' => 'O campo ID da vacina é obrigatório.',
            'idVacina.string' => 'O campo ID da vacina deve ser uma string.',
            'idVacina.min' => 'O campo ID da vacina deve ter exatamente 15 caracteres.',
            'idVacina.max' => 'O campo ID da vacina deve ter exatamente 15 caracteres.',

            'fabricante.string' => 'O fabricante deve ser uma string.',
            'fabricante.max' => 'O fabricante pode ter no máximo 15 caracteres.',

            'nomeVacina.string' => 'O nome da vacina deve ser uma string.',
            'nomeVacina.max' => 'O nome da vacina pode ter no máximo 20 caracteres.',

            'qtdDoses.numeric' => 'A quantidade de doses deve ser um número.',
            'qtdDoses.min' => 'A quantidade de doses não pode ser negativa.',
        ];
    }

}
