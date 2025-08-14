<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paie;
use App\Models\Militaire;

class PaieSeeder extends Seeder
{
    public function run()
    {
        // On récupère tous les militaires (ou une partie si trop lourd)
        $militaires = Militaire::all();

        foreach ($militaires as $militaire) {
            // Générer des paies pour les 12 derniers mois (exemple)
            for ($i = 1; $i <= 12; $i++) {
                $mois = str_pad($i, 2, '0', STR_PAD_LEFT);
                $annee = date('Y');

                // Vérifier qu'on ne crée pas de doublon pour ce mois/année
                $exists = Paie::where('militaire_id', $militaire->id)
                    ->where('mois', $mois)
                    ->where('annee', $annee)
                    ->exists();

                if (!$exists) {
                    Paie::factory()->create([
                        'militaire_id' => $militaire->id,
                        'mois' => $mois,
                        'annee' => $annee,
                    ]);
                }
            }
        }
    }
}
