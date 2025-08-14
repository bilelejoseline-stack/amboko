<?php

namespace Database\Factories;

use App\Models\Localite;
use App\Models\Collectivite;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocaliteFactory extends Factory
{
    protected $model = Localite::class;

    public function definition(): array
    {
        $types = ['Village', 'Quartier', 'Cité'];

        return [
          'nom' => 'Localité ' . $this->faker->city() . ' ' . strtoupper($this->faker->lexify('???')),
            'type' => $this->faker->randomElement($types),
            'chef_local' => $this->faker->name,
            'population' => $this->faker->numberBetween(500, 5000),
            'superficie_km2' => $this->faker->randomFloat(2, 1, 50),
            'latitude' => $this->faker->latitude(-13.0, 5.0), // Latitude RDC
            'longitude' => $this->faker->longitude(12.0, 31.0), // Longitude RDC
            'collectivite_id' => Collectivite::inRandomOrder()->first()?->id, // Associe à une collectivité existante
        ];
    }
}
