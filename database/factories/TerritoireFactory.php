<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Territoire;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerritoireFactory extends Factory
{
    protected $model = Territoire::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->city . ' Territoire',
            'district_id' => District::inRandomOrder()->first()?->id ?? District::factory(),
            'chef_lieu' => $this->faker->city,
            'population' => $this->faker->numberBetween(50000, 1000000),
            'superficie_km2' => $this->faker->numberBetween(500, 10000),
            'latitude' => $this->faker->latitude(-13.5, 5),  // RDC approx
            'longitude' => $this->faker->longitude(12, 31), // RDC approx
        ];
    }
}
