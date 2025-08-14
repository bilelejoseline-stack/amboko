<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Militaire;

class MilitaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Générer 20 militaires avec leurs enfants et paies automatiques
        Militaire::factory()->count(120)->create();
    }
}
