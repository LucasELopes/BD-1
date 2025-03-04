<?php

namespace Database\Seeders;

use App\Models\Lote;
use App\Models\Morador;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vacina;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Morador::factory(10)->create();
        Vacina::factory(10)->create();
        Lote::factory(30)->create();
    }
}
