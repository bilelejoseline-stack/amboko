<?php

namespace Database\Factories;

use App\Models\Specialite;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialiteFactory extends Factory
{
    protected $model = Specialite::class;

    public function definition()
    {
        $noms = [
            'Tireur d’élite', 'Technicien Radio','Losticien','Administratif','Informaticien', 'Commando Parachutiste',
            'Opérateur Drone', 'Spécialiste Cybersécurité', 'Médecin Militaire',
            'Explosifs/Démineur', 'Pilote Hélicoptère', 'Instructeur Combat'
        ];

        return [
            'nom_specialite' => $this->faker->unique()->randomElement($noms),
            'description' => $this->faker->sentence(8),
        ];
    }
}
