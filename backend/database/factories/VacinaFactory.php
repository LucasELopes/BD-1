<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacina>
 */
class VacinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "idVacina" => $this->faker->unique()->regexify('[A-Z0-9]{6}'),
            "fabricante" => $this->faker->text(100),
            "nomeVacina" => $this->faker->text(100),
            "qtdDoses" => $this->faker->numberBetween(),
        ];
    }
}
