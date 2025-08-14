<?php

namespace Database\Factories;

use App\Models\Pays;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pays_id' => Pays::first()->id ?? 1, // Assure-toi que le pays RDC est déjà seedé
            'nom' => $this->faker->unique()->city(),
            'chef_lieu' => $this->faker->city(),
            'region' => $this->faker->word(),
            'population' => $this->faker->numberBetween(500000, 10000000),
            'superficie_km2' => $this->faker->numberBetween(10000, 150000),
            'latitude' => $this->faker->latitude(-13, 5),
            'longitude' => $this->faker->longitude(12, 30),
        ];
    }
}
