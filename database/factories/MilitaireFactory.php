<?php

namespace Database\Factories;

use App\Models\Militaire;
use App\Models\Grade;
use App\Models\Enfant;
use App\Models\Paie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MilitaireFactory extends Factory
{
    protected $model = Militaire::class;

    protected $provincesRDC = [
        'Kinshasa', 'Haut-Katanga', 'Lualaba', 'Tanganyika', 'Haut-Lomami',
        'Lomami', 'Kasaï', 'Kasaï-Central', 'Kasaï-Oriental', 'Sud-Kivu',
        'Nord-Kivu', 'Ituri', 'Tshopo', 'Bas-Uélé', 'Haut-Uélé',
        'Équateur', 'Mongala', 'Nord-Ubangi', 'Sud-Ubangi', 'Tshuapa',
        'Mai-Ndombe', 'Kwilu', 'Kwango', 'Kongo-Central', 'Sankuru', 'Maniema',
    ];

    public function definition(): array
    {
        $prenom = $this->faker->firstName;
        $nom = $this->faker->lastName;
        $postnom = $this->faker->lastName;

        $sexe = $this->faker->randomElement(['M', 'F']);
        $dateNaissance = $this->faker->dateTimeBetween('-50 years', '-18 years');
        $dateIncorporation = $this->faker->dateTimeBetween('-20 years', 'now');

        $matricule = $this->generateMatricule($sexe, $dateNaissance, $dateIncorporation);

        $backgroundColors = ['0D8ABC', 'F39C12', '16A085', '8E44AD', 'C0392B'];
        $bg = $this->faker->randomElement($backgroundColors);

        $slug = Str::slug("{$nom} {$postnom} {$prenom}");

        $province = $this->faker->randomElement($this->provincesRDC);

        return [
            'matricule' => $matricule,
            'nom' => $nom,
            'postnom' => $postnom,
            'prenom' => $prenom,
            'slug' => $slug,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'grade_id' => Grade::inRandomOrder()->first()->id ?? Grade::factory(),
            'fonction' => $this->faker->jobTitle,
            'unite' => $this->faker->word,
            'date_incorporation' => $dateIncorporation->format('Y-m-d'),
            'lieu_incorporation' => $this->faker->city,
            'date_naissance' => $dateNaissance->format('Y-m-d'),
            'lieu_naissance' => $this->faker->city,
            'sexe' => $sexe,
            'etat_civil' => $this->faker->randomElement(['Célibataire', 'Marié(e)', 'Veuf(ve)']),
            'epouse' => $sexe === 'M' ? $this->faker->firstNameFemale : null,
            'papa' => $this->faker->firstNameMale . ' ' . $this->faker->lastName,
            'maman' => $this->faker->firstNameFemale . ' ' . $this->faker->lastName,
            'province' => $province,
            'district' => $this->faker->word,
            'territoire' => $this->faker->word,
            'collectivite' => $this->faker->word,
            'localite' => $this->faker->word,
            'statut' => $this->faker->randomElement(['Actif', 'Réserve', 'Retraité', 'Décédé']),
            'code' => strtoupper(Str::random(6)),
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode("$prenom $nom") . "&background=$bg&color=fff",
        ];
    }

    private function generateMatricule(string $sexe, \DateTime $dateNaissance, \DateTime $dateIncorporation): string
    {
        $sexCode = $sexe === 'M' ? '1' : '2';
        $anneeNaissance = $dateNaissance->format('y');      // ex: 81
        $anneeIncorporation = $dateIncorporation->format('y'); // ex: 99
        $codeRandom = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT); // 5 chiffres aléatoires
        $jourNaissance = $dateNaissance->format('d');       // jour du mois, ex: 22

        // Concaténation sans tirets : total 12 chiffres
        return $sexCode . $anneeNaissance . $anneeIncorporation . $codeRandom . $jourNaissance;
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Militaire $militaire) {
            // Création des enfants liés aléatoires
            Enfant::factory()->count(rand(1, 5))->create([
                'militaire_id' => $militaire->id,
            ]);

            // Création d’une paie associée selon le grade
            $grade = $militaire->grade;
            if ($grade) {
                $solde_base = $grade->solde_base;
                $prime = rand(50000, 150000);
                $retenue = rand(10000, 50000);

                Paie::create([
                    'militaire_id' => $militaire->id,
                    'solde_base' => $solde_base,
                    'prime_combat' => $prime,
                    'retenue' => $retenue,
                    'net_a_payer' => $solde_base + $prime - $retenue,
                    'mois' => now()->month,
                    'annee' => now()->year,
                ]);
            }
        });
    }
}
