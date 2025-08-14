<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $grades = [
            ['nom' => 'Soldat de Deuxième Classe', 'abreviation' => 'Sdt2Cl', 'niveau_hierarchique' => 1, 'solde_base' => 300000],
            ['nom' => 'Soldat de Première Classe', 'abreviation' => 'Sdt1Cl', 'niveau_hierarchique' => 2, 'solde_base' => 320000],
            ['nom' => 'Caporal', 'abreviation' => 'Cpl', 'niveau_hierarchique' => 3, 'solde_base' => 350000],
            ['nom' => 'Sergent', 'abreviation' => 'Sgt', 'niveau_hierarchique' => 4, 'solde_base' => 400000],
            ['nom' => 'Premier Sergent', 'abreviation' => '1Sgt', 'niveau_hierarchique' => 5, 'solde_base' => 420000],
            ['nom' => 'Sergent Major', 'abreviation' => 'SgtMaj', 'niveau_hierarchique' => 6, 'solde_base' => 450000],
            ['nom' => 'Adjudant', 'abreviation' => 'Adj', 'niveau_hierarchique' => 7, 'solde_base' => 500000],
            ['nom' => 'Adjudant de Première Classe', 'abreviation' => 'Adj1Cl', 'niveau_hierarchique' => 7, 'solde_base' => 500000],
            ['nom' => 'Adjudant-Chef', 'abreviation' => 'AdjChef', 'niveau_hierarchique' => 8, 'solde_base' => 550000],
            ['nom' => 'Sous-Lieutenant', 'abreviation' => 'SLt', 'niveau_hierarchique' => 9, 'solde_base' => 600000],
            ['nom' => 'Lieutenant', 'abreviation' => 'Lt', 'niveau_hierarchique' => 10, 'solde_base' => 650000],
            ['nom' => 'Capitaine', 'abreviation' => 'Capt', 'niveau_hierarchique' => 11, 'solde_base' => 700000],
            ['nom' => 'Major', 'abreviation' => 'Maj', 'niveau_hierarchique' => 12, 'solde_base' => 750000],
            ['nom' => 'Lieutenant-Colonel', 'abreviation' => 'LtCol', 'niveau_hierarchique' => 13, 'solde_base' => 800000],
            ['nom' => 'Colonel', 'abreviation' => 'Col', 'niveau_hierarchique' => 14, 'solde_base' => 850000],
            ['nom' => 'Général de Brigade', 'abreviation' => 'GenBde', 'niveau_hierarchique' => 15, 'solde_base' => 900000],
            ['nom' => 'Général-Major', 'abreviation' => 'GenMaj', 'niveau_hierarchique' => 16, 'solde_base' => 950000],
            ['nom' => 'Lieutenant-Général', 'abreviation' => 'LtGent', 'niveau_hierarchique' => 17, 'solde_base' => 1000000],
            ['nom' => 'Général d’Armée', 'abreviation' => 'GenA', 'niveau_hierarchique' => 18, 'solde_base' => 1200000],
        ];

        foreach ($grades as $grade) {
            Grade::updateOrCreate(
                ['nom' => $grade['nom']],  // clé unique
                [
                    'abreviation' => $grade['abreviation'],
                    'niveau_hierarchique' => $grade['niveau_hierarchique'],
                    'solde_base' => $grade['solde_base'],
                ]
            );
        }
    }
}
