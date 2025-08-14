<?php

namespace Database\Factories;

use App\Models\Promotion;
use App\Models\Militaire;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    protected $model = Promotion::class;

    public function definition()
    {
        return [
            'militaire_id' => Militaire::factory(), // Ou à override dans le seeder
            'grade_id' => Grade::factory(),         // Idem
            'date_promotion' => $this->faker->date(),
            'decision_numero' => 'DEC-' . $this->faker->unique()->numberBetween(1000, 9999),
            'commentaire' => $this->faker->sentence(),
        ];
    }
}
