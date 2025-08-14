<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pays;

class PaysSeeder extends Seeder
{
    public function run(): void
    {
        Pays::create([
            'nom' => 'République Démocratique du Congo',
            'nom_court' => 'RDC',
            'capitale' => 'Kinshasa',
            'continent' => 'Afrique',
            'region' => 'Afrique Centrale',
            'code_iso2' => 'CD',
            'code_iso3' => 'COD',
            'indicatif_telephonique' => '+243',
            'monnaie' => 'Franc Congolais',
            'code_monnaie' => 'CDF',
            'fuseau_horaire' => 'Africa/Kinshasa',
            'domaine_internet' => '.cd',
            'drapeau_url' => 'url_du_drapeau',
            'langue_officielle' => 'Français',
            'population' => 92000000,
            'superficie_km2' => 2344858,
            'latitude' => -4.3217,
            'longitude' => 15.3126,
        ]);
    }
}
