<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistrictFactory extends Factory
{
    protected $model = District::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->city(),
            'province_id' => Province::inRandomOrder()->first()->id ?? Province::factory(),
            'chef_lieu' => $this->faker->city(),
            'population' => $this->faker->numberBetween(50000, 1000000),
            'superficie_km2' => $this->faker->numberBetween(1000, 10000),
            'latitude' => $this->faker->latitude(-13, 5),
            'longitude' => $this->faker->longitude(12, 30),
        ];
    }
}
