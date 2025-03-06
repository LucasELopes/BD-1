<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Aplicacao;

class AplicacaoRequest extends FormRequest
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
            'cpfMorador' => ['string', 'exists:moradores,cpfMorador'],
            'idVacina' => ['string', 'exists:vacinas,idVacina'],
            'idLote' => ['string', 'exists:lotes,idLote'],
            'dataAplicacao' => ['date'],
            'doseAplicada' => ['integer', 'min:1']
        ];

        if($this->isMethod('post')) {
            $postRules = [
                'cpfMorador' => ['required'],
                'idVacina'=> ['required'],
                'idLote' => ['required'],
                'dataAplicacao'=> ['required'],
                'doseAplicada'=> ['required']
            ];
        }

        if($this->isMethod('put')) {
            $putRules = [
                'cpfMorador' => ['sometimes'],
                'idVacina'=> ['sometimes'],
                'idLote' => ['sometimes'],
                'dataAplicacao'=> ['sometimes'],
                'doseAplicada'=> ['sometimes']
            ];
        }

        return array_merge_recursive($rules, $postRules, $putRules);
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Verifica se todos os dados já existem no banco
            $aplicacaoExistente = Aplicacao::where('cpfMorador', $this->cpfMorador)
                ->where('idVacina', $this->idVacina)
                ->where('idLote', $this->idLote)
                ->where('dataAplicacao', $this->dataAplicacao)
                ->where('doseAplicada', $this->doseAplicada)
                ->exists();

            if ($aplicacaoExistente) {
                $validator->errors()->add(
                    'aplicacao', 'Esta aplicação já existe no banco de dados.'
                );
            }

            // Verifica se essa dose já foi aplicada neste morador (da mesma vacina no caso)
            $doseAplicada = Aplicacao::where('cpfMorador', $this->cpfMorador)
                ->where('idVacina', $this->idVacina)
                ->where('doseAplicada', $this->doseAplicada)
                ->exists();

            if ($doseAplicada) {
                $validator->errors()->add(
                    'doseAplicada', 'Esta dose da vacina já foi aplicada para este morador.'
                );
            }
        });
    }

    public function messages(): array
    {
        return [
            'cpfMorador.required' => 'O CPF do morador é obrigatório.',
            'cpfMorador.exists' => 'O CPF informado não foi encontrado.',

            'idVacina.required' => 'O código da vacina é obrigatório',
            'idVacina.exists' => 'A vacina informada não existe.',

            'idLote.required' => 'O código do lote é obrigatório.',
            'idLote.exists' => 'O código do lote informado não existe.',

            'dataAplicacao.required' => 'A data de aplicação é obrigatória.',
            'dataAplicacao.date' => 'A data de aplicação deve ser uma data válida.',

            'doseAplicada.required' => 'A dose aplicada é obrigatória.',
            'doseAplicada.integer' => 'A dose aplicada deve ser um número inteiro.',
            'doseAplicada.min' => 'O mínimo de doses aceitas é igual a 1.'
        ];
    }
}

