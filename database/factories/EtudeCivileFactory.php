<?php

namespace Database\Factories;

use App\Models\EtudeCivile;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudeCivileFactory extends Factory
{
    protected $model = EtudeCivile::class;

    public function definition()
    {
        $domaines = [
            'Informatique de Gestion', 'Droit', 'Médecine', 'Génie Civil', 'Sciences Politiques', 'Économie',
            'Psychologie', 'Mathématiques', 'Langues Modernes', 'Histoire-Géographie'
        ];

        $intitule = $this->faker->randomElement($domaines);
        $annee_debut = $this->faker->numberBetween(2000, 2015);
        $annee_fin = $annee_debut + $this->faker->numberBetween(3, 5);

        return [
            'intitule' => $intitule,
            'etablissement' => $this->faker->company . ' Université',
            'lieu' => $this->faker->city,
            'diplome' => 'Licence en ' . $intitule,
            'mention' => $this->faker->randomElement(['Passable', 'Distinction', 'Grande Distinction']),
            'date_debut' => "$annee_debut-10-01",
            'date_fin' => "$annee_fin-07-01",
            'annee_obtention' => $annee_fin,
        ];
    }
}
