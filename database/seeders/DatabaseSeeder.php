<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Désactiver les contraintes FK pour éviter les erreurs pendant le seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate les tables si besoin (à adapter selon ta stratégie)
        // DB::table('users')->truncate();
        // DB::table('militaires')->truncate();
        // ...

        // Appeler les seeders dans l’ordre logique

        $this->call([
            // Rôles et permissions (si tu utilises Spatie)
            RoleSeeder::class,

            // Grades militaires
            GradeSeeder::class,

            // Données géopolitiques et locales
            PaysSeeder::class,
            ProvinceSeeder::class,
            DistrictSeeder::class,
            TerritoireSeeder::class,
            CollectiviteSeeder::class,
            LocaliteSeeder::class,

            // Utilisateurs et militaires liés
            UserSeeder::class,

            // Données spécifiques militaires
            MilitaireSeeder::class,
            PromotionSeeder::class,
            AffectationSeeder::class,
            HistoriqueMilitaireSeeder::class,
            EtudeCivileSeeder::class,
            EtudeMilitaireSeeder::class,
            SpecialiteSeeder::class,
            PaieSeeder::class,
            SanteMilitaireSeeder::class,
            AboutSeeder::class,

            // Autres données utiles (galerie, documents, équipes, etc.)
            GallerySeeder::class,
            TeamSeeder::class,
            DocumentSeeder::class,
        ]);

        // Réactiver les contraintes FK
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
