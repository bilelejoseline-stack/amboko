<?php

namespace Database\Seeders;

use App\Models\Collectivite;
use App\Models\Localite;
use Illuminate\Database\Seeder;

class LocaliteSeeder extends Seeder
{
    public function run(): void
    {
        // Pour chaque collectivité, créer entre 5 et 10 localités réalistes
        Collectivite::all()->each(function ($collectivite) {
            Localite::factory()
                ->count(rand(5, 10))
                ->create(['collectivite_id' => $collectivite->id]);
        });

        $this->command->info('✅ Localités créées avec succès pour chaque collectivité.');
    }
}
