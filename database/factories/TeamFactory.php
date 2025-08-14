<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->name();
        $slug = Str::slug($name . '-' . Str::random(4));

        return [
            'name'    => $name,
            'slug'    => $slug,
            'role'    => $this->faker->jobTitle(),
            'avatar'  => 'teams/avatar-' . $this->faker->numberBetween(1, 5) . '.jpg', // Ex: public/teams/avatar-3.jpg
            'bio'     => $this->faker->paragraph(),
            'active'  => $this->faker->boolean(90), // 90% des membres actifs
        ];
    }
}
