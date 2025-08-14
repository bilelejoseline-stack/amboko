<?php

namespace Database\Factories;

use App\Models\Enfant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnfantFactory extends Factory
{
    protected $model = Enfant::class;

    public function definition(): array
    {
        $prenom = $this->faker->firstName;
        $nom = $this->faker->lastName;
        $postnom = $this->faker->lastName;

        return [
            'nom' => $nom,
            'postnom' => $postnom,
            'prenom' => $prenom,
            'date_naissance' => $this->faker->date(),
            'lieu_naissance' => $this->faker->city,
            'sexe' => $this->faker->randomElement(['M', 'F']),
        ];
    }
}
