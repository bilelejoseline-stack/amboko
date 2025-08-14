<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Militaire;
use App\Models\Specialite;

class SpecialiteSeeder extends Seeder
{
    public function run()
    {
        // Crée 10 spécialités uniques
        $specialites = Specialite::factory()->count(10)->create();

        // Affecte aléatoirement 1 à 3 spécialités à chaque militaire
        Militaire::all()->each(function ($militaire) use ($specialites) {
            $randomSpecialites = $specialites->random(rand(1, 3))->pluck('id');
            $militaire->specialites()->sync($randomSpecialites);
        });
    }
}
