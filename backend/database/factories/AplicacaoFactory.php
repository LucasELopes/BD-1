<?php

namespace Database\Factories;

use App\Models\Morador;
use App\Models\Vacina;
use App\Models\Lote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\aplicacao>
 */
class AplicacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'cpfMorador' => Morador::all()->random()->cpfMorador,

            'idVacina' => Vacina::all()->random()->idVacina,

            'idLote' => Lote::all()->random()->idLote,

            'dataAplicacao' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),

            'doseAplicada' => $this->faker->numberBetween(1, 4)

        ];
    }
}
