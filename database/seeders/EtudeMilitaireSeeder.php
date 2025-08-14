<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Militaire;
use App\Models\EtudeMilitaire;

class EtudeMilitaireSeeder extends Seeder
{
    public function run()
    {
        Militaire::all()->each(function ($militaire) {
            // Chaque militaire reçoit 1 à 2 formations militaires
            EtudeMilitaire::factory()
                ->count(rand(1, 2))
                ->for($militaire)
                ->create();
        });
    }
}
