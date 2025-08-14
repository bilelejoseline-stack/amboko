<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collectivite;
use App\Models\Territoire;

class CollectiviteSeeder extends Seeder
{
    public function run(): void
    {
        $territoires = Territoire::all();

        if ($territoires->isEmpty()) {
            $this->command->warn('Aucun territoire trouvé. Veuillez d\'abord seeder les territoires.');
            return;
        }

        $territoires->each(function ($territoire) {
            Collectivite::factory()
                ->count(5)
                ->create(['territoire_id' => $territoire->id]);
        });

        $this->command->info('✅ 5 collectivités créées pour chaque territoire.');
    }
}
