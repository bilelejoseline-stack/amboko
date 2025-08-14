<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SanteMilitaire;

class SanteMilitaireSeeder extends Seeder
{
    public function run(): void
    {
        // Crée 10 fiches de santé militaire
        SanteMilitaire::factory()->count(10)->create();
    }
}
