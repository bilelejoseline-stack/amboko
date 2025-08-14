<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        // Générer 5 abouts
        About::factory()->count(5)->create();
    }
}
