<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;
use App\Models\Province;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifie que les provinces existent
        if (Province::count() === 0) {
            $this->command->warn('Aucune province trouvée. Veuillez d’abord exécuter le ProvinceSeeder.');
            return;
        }

        // Création de 5 districts par province
        Province::all()->each(function ($province) {
            District::factory()->count(5)->create(['province_id' => $province->id]);
        });

        $this->command->info('Districts créés pour chaque province.');
    }
}
