<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Militaire;
use App\Models\HistoriqueMilitaire;

class HistoriqueMilitaireSeeder extends Seeder
{
    public function run()
    {
        $militaires = Militaire::all();

        foreach ($militaires as $militaire) {
            $eventsCount = rand(2, 5); // Chaque militaire a entre 2 et 5 événements

            for ($i = 0; $i < $eventsCount; $i++) {
                $dateEvenement = now()->subYears(rand(1, 15))->subMonths(rand(0, 11));

                HistoriqueMilitaire::create([
                    'militaire_id' => $militaire->id,
                    'type_evenement' => ['Mission', 'Formation', 'Récompense', 'Inspection'][rand(0, 3)],
                    'description' => 'Événement marquant - généré pour la chronologie.',
                    'date_evenement' => $dateEvenement->format('Y-m-d'),
                    'lieu' => 'Lieu ' . rand(1, 100),
                    'reference_document' => 'DOC-' . strtoupper(uniqid()),
                ]);
            }
        }
    }
}
