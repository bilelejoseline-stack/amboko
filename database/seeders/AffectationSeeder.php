<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Affectation;
use App\Models\Militaire;

class AffectationSeeder extends Seeder
{
    public function run()
    {
        $militaires = Militaire::all();

        foreach ($militaires as $militaire) {
            // Affecter entre 1 et 3 missions par militaire
            $nb = rand(1, 3);

            for ($i = 0; $i < $nb; $i++) {
                $dateDebut = now()->subYears(rand(1, 10))->subMonths(rand(0, 11));
                $dateFin = rand(0, 1) ? $dateDebut->copy()->addMonths(rand(6, 36)) : null;

                Affectation::create([
                    'militaire_id' => $militaire->id,
                    'poste' => 'Poste ' . strtoupper(chr(65 + $i)),
                    'unite' => 'Unité ' . rand(1, 10),
                    'date_debut' => $dateDebut->format('Y-m-d'),
                    'date_fin' => $dateFin?->format('Y-m-d'),
                    'commentaires' => 'Affectation générée automatiquement.',
                ]);
            }
        }
    }
}
