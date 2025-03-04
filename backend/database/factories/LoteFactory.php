<?php

namespace Database\Factories;

use App\Models\Vacina;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lote>
 */
class LoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'idLote'=> $this->faker->unique()->regexify('[A-Z0-9]{6}'),
            'idVacina'=> Vacina::all()->random()->idVacina,
            'validade'=>
                $this->faker
                    ->dateTimeBetween('-1 month', '+1 month')
                    ->format('Y-m-d'),
            'qtdRecebida' => $this->faker->numberBetween(500, 600),
            'qtdDisponivel' => $this->faker->numberBetween(0, 500),
        ];
    }
}
