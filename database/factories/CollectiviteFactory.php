<?php

namespace Database\Factories;

use App\Models\Collectivite;
use App\Models\Territoire;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CollectiviteFactory extends Factory
{
    protected $model = Collectivite::class;

    public function definition(): array
    {
        $types = ['Chefferie', 'Secteur'];

        return [
            'nom' => 'Collectivité de ' . $this->faker->city() . ' ' . Str::upper(Str::random(3)),
            'type' => $this->faker->randomElement($types),
            'chef_lieu' => $this->faker->city(),
            'population' => $this->faker->numberBetween(5000, 50000),
            'superficie_km2' => $this->faker->randomFloat(2, 50, 500),
            'latitude' => $this->faker->latitude(-13, 5),   // RDC approx
            'longitude' => $this->faker->longitude(12, 31),
            'territoire_id' => Territoire::factory(), // ok si seeder automatique
        ];
    }
}
