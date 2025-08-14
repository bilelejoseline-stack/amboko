<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SanteMilitaireFactory extends Factory
{
    protected $model = \App\Models\SanteMilitaire::class;

    public function definition(): array
    {
        $titre = $this->faker->sentence(4);

        // Générer 1 à 3 contenus JSON (riches)
        $contenus = collect(range(1, rand(1, 3)))->map(function () {
            return [
                'sous_titre' => $this->faker->sentence(3),
                'description' => '<p>' . implode('</p><p>', $this->faker->paragraphs(2)) . '</p>',
            ];
        })->toArray();

        return [
            'titre' => $titre,
            'slug' => Str::slug($titre),
            'sous_titre' => $this->faker->sentence(3),
            'description' => '<p>' . implode('</p><p>', $this->faker->paragraphs(2)) . '</p>',
            'contenus' => $contenus,
            'image' => null, // Vous pouvez remplacer par 'test.jpg' si vous avez une image par défaut
            'active' => $this->faker->boolean(80),
        ];
    }
}
