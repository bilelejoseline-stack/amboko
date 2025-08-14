<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Pays;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $rdc = Pays::where('code_iso3', 'COD')->first();

        if (!$rdc) {
            $this->command->error("Le pays RDC (code_iso3: 'COD') n'existe pas !");
            return;
        }

        $provinces = [
            ['nom' => 'Kinshasa', 'chef_lieu' => 'Kinshasa'],
            ['nom' => 'Kongo-Central', 'chef_lieu' => 'Matadi'],
            ['nom' => 'Kwilu', 'chef_lieu' => 'Bandundu'],
            ['nom' => 'Kwango', 'chef_lieu' => 'Kenge'],
            ['nom' => 'Mai-Ndombe', 'chef_lieu' => 'Inongo'],
            ['nom' => 'Tshuapa', 'chef_lieu' => 'Boende'],
            ['nom' => 'Mongala', 'chef_lieu' => 'Lisala'],
            ['nom' => 'Nord-Ubangi', 'chef_lieu' => 'Gbadolite'],
            ['nom' => 'Sud-Ubangi', 'chef_lieu' => 'Gemena'],
            ['nom' => 'Équateur', 'chef_lieu' => 'Mbandaka'],
            ['nom' => 'Tshopo', 'chef_lieu' => 'Kisangani'],
            ['nom' => 'Bas-Uele', 'chef_lieu' => 'Buta'],
            ['nom' => 'Haut-Uele', 'chef_lieu' => 'Isiro'],
            ['nom' => 'Ituri', 'chef_lieu' => 'Bunia'],
            ['nom' => 'Haut-Lomami', 'chef_lieu' => 'Kamina'],
            ['nom' => 'Lomami', 'chef_lieu' => 'Kabinda'],
            ['nom' => 'Kasai', 'chef_lieu' => 'Luebo'],
            ['nom' => 'Kasai-Central', 'chef_lieu' => 'Kananga'],
            ['nom' => 'Kasai-Oriental', 'chef_lieu' => 'Mbuji-Mayi'],
            ['nom' => 'Tanganyika', 'chef_lieu' => 'Kalemie'],
            ['nom' => 'Haut-Katanga', 'chef_lieu' => 'Lubumbashi'],
            ['nom' => 'Lualaba', 'chef_lieu' => 'Kolwezi'],
            ['nom' => 'Sud-Kivu', 'chef_lieu' => 'Bukavu'],
            ['nom' => 'Nord-Kivu', 'chef_lieu' => 'Goma'],
            ['nom' => 'Maniema', 'chef_lieu' => 'Kindu'],
            ['nom' => 'Sankuru', 'chef_lieu' => 'Lusambo'],
        ];

        foreach ($provinces as $data) {
            Province::create([
                'pays_id' => $rdc->id,
                'nom' => $data['nom'],
                'chef_lieu' => $data['chef_lieu'],
                'region' => 'RDC',
                'population' => rand(500000, 5000000),
                'superficie_km2' => rand(15000, 120000),
                'latitude' => fake()->latitude(-13, 5),
                'longitude' => fake()->longitude(12, 30),
            ]);
        }
    }
}
