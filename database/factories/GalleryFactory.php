<?php

namespace Database\Factories;

use App\Models\GalleryCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->sentence(10),
            'image' => $this->faker->imageUrl(800, 600, 'military', true, 'FARDC'), // image factice
            'gallery_category_id' => GalleryCategory::inRandomOrder()->first()?->id, // FK dynamique
            'active' => $this->faker->boolean(90), // 90% des images actives
        ];
    }
}
