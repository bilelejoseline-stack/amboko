<?php

namespace Database\Factories;

use App\Models\EtudeMilitaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudeMilitaireFactory extends Factory
{
    protected $model = EtudeMilitaire::class;

    public function definition()
    {
        $etudes = [
            'Formation de Base', 'Commando', 'École de Guerre', 'Stratégie Avancée', 'État-Major',
            'Pilotage de Drone', 'Opérations Spéciales', 'Renseignement', 'Logistique Militaire','Administration Militaire'
        ];

        $institution = $this->faker->randomElement([
            'Académie Militaire de Kinshasa',
            'Centre de Formation de Kitona',
            'École de Guerre de Ndolo',
            'Base Militaire de Kolwezi'
        ]);

        $pays = $this->faker->randomElement(['RDC', 'Angola', 'Rwanda', 'Afrique du Sud', 'France', 'Chine']);

        $nom_etude = $this->faker->randomElement($etudes);
        $annee_debut = $this->faker->numberBetween(2000, 2018);
        $annee_fin = $annee_debut + $this->faker->numberBetween(1, 2);

        return [
            'nom_etude' => $nom_etude,
            'institution' => $institution,
            'pays' => $pays,
            'date_debut' => "$annee_debut-01-15",
            'date_fin' => "$annee_fin-12-15",
            'annee_obtention' => $annee_fin,
            'titre' => "Certificat de $nom_etude",
            'description' => $this->faker->sentence(8),
        ];
    }
}
