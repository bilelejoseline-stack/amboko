<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promotion;
use App\Models\Militaire;
use App\Models\Grade;

class PromotionSeeder extends Seeder
{
    public function run()
    {
        $militaires = Militaire::all();
        $grades = Grade::all();

        foreach ($militaires as $militaire) {
            // Attribuer une promotion aléatoire parmi les grades
            $grade = $grades->random();

            Promotion::create([
                'militaire_id' => $militaire->id,
                'grade_id' => $grade->id,
                'date_promotion' => now()->subYears(rand(1, 10))->format('Y-m-d'),
                'decision_numero' => 'DEC-' . rand(1000, 9999),
                'commentaire' => 'Promotion automatique pour test.',
            ]);
        }
    }
}
