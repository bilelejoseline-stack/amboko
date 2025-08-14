<?php

namespace Database\Factories;

use App\Models\Affectation;
use App\Models\Militaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffectationFactory extends Factory
{
    protected $model = Affectation::class;

    public function definition()
    {
        $dateDebut = $this->faker->dateTimeBetween('-10 years', '-1 year');
        $dateFin = (clone $dateDebut)->modify('+'.rand(6, 36).' months');

        return [
            'militaire_id' => Militaire::factory(), // Override dans le seeder
            'poste' => $this->faker->jobTitle(),
            'unite' => $this->faker->company() . ' - Unité',
            'date_debut' => $dateDebut->format('Y-m-d'),
            'date_fin' => rand(0, 1) ? $dateFin->format('Y-m-d') : null, // Peut être en cours
            'commentaires' => $this->faker->sentence(),
        ];
    }
}
