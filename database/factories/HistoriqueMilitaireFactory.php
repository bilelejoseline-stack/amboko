<?php

namespace Database\Factories;

use App\Models\HistoriqueMilitaire;
use App\Models\Militaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoriqueMilitaireFactory extends Factory
{
    protected $model = HistoriqueMilitaire::class;

    public function definition()
    {
        $types = ['Mission', 'Formation', 'Récompense', 'Discipline', 'Inspection', 'Déploiement'];
        $dateEvenement = $this->faker->dateTimeBetween('-15 years', 'now');

        return [
            'militaire_id' => Militaire::factory(), // Overridden dans le seeder
            'type_evenement' => $this->faker->randomElement($types),
            'description' => $this->faker->sentence(10),
            'date_evenement' => $dateEvenement->format('Y-m-d'),
            'lieu' => $this->faker->city(),
            'reference_document' => strtoupper($this->faker->bothify('REF-####/????')),
        ];
    }
}
