<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        // Génère 10 membres fictifs
        Team::factory()->count(10)->create();
    }
}
