<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoradorRequest extends FormRequest
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
            'cpfMorador'=> ['string', 'unique:moradores,cpfMorador','min:11', 'max:11'],
            'nmrSUS'=> ['string', 'min:15', 'max:15'],
            'nomeMorador'=> ['string','max:100'],
            'nomeMae'=> ['string','max:100'],
            'sexo' => ['string',' min:1', 'max: 1'],
            'endereco' => ['string', 'max:255'],
            'estadoCivil' => ['string', 'max:20'],
            'escolaridade' => ['string', 'max:35'],
            'etnia' => ['string', 'max:15'],
            'planoSaude' => ['boolean'],
            'dataNascimento' => ['date']
        ];

        if($this->isMethod('post')) {
            $postRules = [
                'cpfMorador' => ['required'],
                'nmrSUS'=> ['required'],
                'nomeMorador' => ['required'],
                'nomeMae'=> ['required'],
                'sexo'=> ['required'],
                'endereco'=> ['required'],
                'estadoCivil'=> ['required'],
                'escolaridade'=> ['required'],
                'etnia'=> ['required'],
                'planoSaude'=> ['required'],
                'dataNascimento'=> ['required'],
            ];
        }

        if($this->isMethod('put')) {
            $putRules = [
                'cpfMorador' => ['sometimes'],
                'nmrSUS'=> ['sometimes'],
                'nomeMorador' => ['sometimes'],
                'nomeMae'=> ['sometimes'],
                'sexo'=> ['sometimes'],
                'endereco'=> ['sometimes'],
                'estadoCivil'=> ['sometimes'],
                'escolaridade'=> ['sometimes'],
                'etnia'=> ['sometimes'],
                'planoSaude'=> ['sometimes'],
                'dataNascimento'=> ['sometimes'],
            ];
        }

        return array_merge_recursive($rules, $postRules, $putRules);
    }

    public function messages(): array
    {
        return [
            'cpfMorador.required' => 'O CPF do morador é obrigatório.',
            'cpfMorador.unique' => 'O CPF já existe.',
            'cpfMorador.string' => 'O CPF deve ser uma string.',
            'cpfMorador.min' => 'O CPF deve ter exatamente 11 dígitos.',
            'cpfMorador.max' => 'O CPF deve ter exatamente 11 dígitos.',

            'nmrSUS.string' => 'O número do SUS deve ser uma string.',
            'nmrSUS.min' => 'O número do SUS deve ter exatamente 15 dígitos.',
            'nmrSUS.max' => 'O número do SUS deve ter exatamente 15 dígitos.',

            'nomeMorador.required' => 'O nome do morador é obrigatório.',
            'nomeMorador.string' => 'O nome do morador deve ser uma string.',
            'nomeMorador.max' => 'O nome do morador não pode ter mais de 100 caracteres.',

            'nomeMae.string' => 'O nome da mãe deve ser uma string.',
            'nomeMae.max' => 'O nome da mãe não pode ter mais de 100 caracteres.',

            'sexo.boolean' => 'O campo sexo deve ser verdadeiro ou falso.',
            'sexo.min' => 'O sexo deve ter exatamente 1 dígitos.',
            'sexo.max' => 'O sexo deve ter exatamente 1 dígitos.',

            'endereco.string' => 'O endereço deve ser uma string.',
            'endereco.max' => 'O endereço não pode ter mais de 255 caracteres.',

            'estadoCivil.string' => 'O estado civil deve ser uma string.',
            'estadoCivil.max' => 'O estado civil não pode ter mais de 20 caracteres.',

            'escolaridade.string' => 'A escolaridade deve ser uma string.',
            'escolaridade.max' => 'A escolaridade não pode ter mais de 35 caracteres.',

            'etnia.string' => 'A etnia deve ser uma string.',
            'etnia.max' => 'A etnia não pode ter mais de 15 caracteres.',

            'planoSaude.boolean' => 'O campo plano de saúde deve ser verdadeiro ou falso.',

            'dataNascimento.date' => 'A data de nascimento deve estar no formato válido de data (YYYY-MM-DD).',
        ];
    }
}
