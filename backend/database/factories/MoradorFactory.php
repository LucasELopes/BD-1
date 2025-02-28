<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Morador>
 */
class MoradorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "cpfMorador" => $this->faker->randomNumber(9) .''. $this->faker->randomNumber(2),
            "nmrSUS" => $this->faker->randomNumber(9) ."". $this->faker->randomNumber(6),
            "nomeMorador" => $this->faker->name(),
            "nomeMae" => $this->faker->name("female"),
            "dataNascimento" => $this->faker->date(),
            "sexo" => $this->faker->randomElement(['M', 'F']),
            "endereco" => $this->faker->address(),
            "estadoCivil" => $this->faker->randomElement([
                'Solteiro(a)',
                'Casado(a)',
                'Divrociado(a)',
                'Viúvo(a)',
                'Separado(a)'
            ]),
            "escolaridade" => $this->faker->randomElement([
                'Fundamental incompleto',
                'Fundamental completo',
                'Ensino Superior',
                'Médio incompleto',
                'Médio completo',
                'Superior incompleto',
                'Superior completo',
                'Pós-graduação incompleto',
                'Pós-graduação completo'
            ]),
            "etnia" => $this->faker->randomElement(['Indígena', 'Branca', 'Preta', 'Parda']),
            "planoSaude" => $this->faker->boolean()
        ];
    }
}
