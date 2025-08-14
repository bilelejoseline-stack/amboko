<?php

namespace Database\Factories;

use App\Models\Paie;
use App\Models\Militaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaieFactory extends Factory
{
    protected $model = Paie::class;

    public function definition()
    {
        $soldeBase = $this->faker->numberBetween(300000, 1200000);
        $primeCombat = $this->faker->randomFloat(2, 0, 100000);
        $primeRisque = $this->faker->randomFloat(2, 0, 50000);
        $autresPrimes = $this->faker->randomFloat(2, 0, 30000);
        $retenue = $this->faker->randomFloat(2, 0, 20000);
        $mois = str_pad($this->faker->numberBetween(1, 12), 2, '0', STR_PAD_LEFT);
        $annee = $this->faker->numberBetween(2018, date('Y'));

        return [
            'militaire_id' => Militaire::inRandomOrder()->first()->id,
            'solde_base' => $soldeBase,
            'prime_combat' => $primeCombat,
            'prime_risque' => $primeRisque,
            'autres_primes' => $autresPrimes,
            'retenue' => $retenue,
            'net_a_payer' => $soldeBase + $primeCombat + $primeRisque + $autresPrimes - $retenue,
            'mois' => $mois,
            'annee' => $annee,
        ];
    }
}
