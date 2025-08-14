<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GalleryCategory;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Créer des catégories de base
        $categories = ['opérations', 'formations', 'cérémonies', 'équipements', 'personnel'];

        foreach ($categories as $cat) {
            GalleryCategory::firstOrCreate(['name' => $cat]);
        }

        // 2. Récupérer toutes les catégories en DB
        $allCategories = GalleryCategory::all();

        // 3. Générer 30 images dans la galerie, assignées aléatoirement aux catégories
        Gallery::factory()
            ->count(30)
            ->make()
            ->each(function ($gallery) use ($allCategories) {
                $gallery->gallery_category_id = $allCategories->random()->id;
                $gallery->save();
            });
    }
}
