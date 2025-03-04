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
        $fabricante = [
            "Pfizer", "Moderna", "AstraZeneca", "Johnson & Johnson (Janssen)",
            "Sinovac","Sinopharm","Novavax","Sanofi Pasteur","GlaxoSmithKline","Bharat Biotech"
        ];

        $vacinas = [
            "CoronaVac", "Comirnaty", "Spikevax", "Vaxzevria",
            "Jcovden", "BBIBP-CorV", "Nuvaxovid", "Covaxin",
            "Sputnik V", "Fluzone", "Gardasil", "BCG",
            "Pentavalente", "Tríplice Viral", "DTP", "Hepatite B",
            "Rotavírus", "Pneumocócica", "Meningocócica", "Influenza"
        ];

        return [
            "idVacina" => $this->faker->unique()->regexify('[A-Z0-9]{6}'),
            "fabricante" => $this->faker->randomElement($fabricante),
            "nomeVacina" => $this->faker->randomElement($vacinas),
            "qtdDoses" => $this->faker->numberBetween(),
        ];
    }
}
