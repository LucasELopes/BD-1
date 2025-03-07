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

            'idLote' => function () {
                $lote = Lote::all()->random()->first();
                return $lote ? $lote->idLote : null;
            },

            'idVacina' => function (array $attributes) {
                $lote = Lote::where('idLote', $attributes['idLote'])->first();
                return $lote ? $lote->idVacina : null;
            },

            'dataAplicacao' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),

            'doseAplicada' => $this->faker->numberBetween(1, 4)
        ];

    }
}
