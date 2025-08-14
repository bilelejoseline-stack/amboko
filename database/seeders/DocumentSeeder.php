<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\User;

class DocumentSeeder extends Seeder
{
    /**
     * Exécution du seeder.
     */
    public function run(): void
    {
        // Créer d'abord des utilisateurs s’ils n'existent pas
        if (User::count() === 0) {
            User::factory()->count(5)->create();
        }

        // Générer 50 documents avec association aléatoire à des users
        Document::factory()
            ->count(150)
            ->create();
    }
}
