<?php

namespace Database\Factories;

use App\Models\About;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AboutFactory extends Factory
{
    protected $model = About::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'subtitles' => collect([
                ['value' => $this->faker->sentence(6)],
                ['value' => $this->faker->sentence(6)],
            ])->toArray(),
            'descriptions' => collect([
                ['value' => '<p>' . $this->faker->paragraph(3) . '</p>'],
                ['value' => '<p>' . $this->faker->paragraph(2) . '</p>'],
            ])->toArray(),
            'image' => 'abouts/images/sample.jpg', // Exemple d'image fixe
            'video' => 'abouts/videos/sample.mp4', // Exemple de vidéo locale
            'active' => $this->faker->boolean(80),
        ];
    }
}
