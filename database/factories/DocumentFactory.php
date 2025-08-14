<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition(): array
    {
        $reference = 'DOC-' . $this->faker->unique()->numberBetween(1000, 9999);

        return [
            'user_id'        => User::factory(), // ou ->random() si users existent
            'reference'      => $reference,
            'slug'           => Str::slug($reference) . '-' . Str::random(4),

            'objet'          => $this->faker->sentence(4),
            'description'    => $this->faker->paragraph(),

            'type_document'  => $this->faker->randomElement([
                'Lettre',
                'Rapport',
                'Note',
                'Décision',
                'Ordre de Mission',
                'Instruction',
                'Message',
                'Mémo',
                'Télégramme',
                'Ordonnance',
                'Sitrep',
                'Fiche',
                'Requête',
                'Autre',
            ]),

            'date_document'  => $this->faker->date(),
            'date_reception' => $this->faker->optional()->date(),
            'date_sortie'    => $this->faker->optional()->date(),

            'provenance'     => $this->faker->company(),
            'destinataire'   => $this->faker->name(),

            'statut'         => $this->faker->randomElement(['Enregistré', 'En attente', 'Traité', 'Classé']),
            'priorite'       => $this->faker->randomElement(['Basse', 'Normale', 'Haute', 'Urgente']),

            'mention'        => $this->faker->optional()->sentence(3),
            'observations'   => $this->faker->optional()->sentence(6),

            'fichier'        => 'documents/' . Str::random(12) . '.pdf',
        ];
    }
}
