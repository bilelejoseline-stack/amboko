<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'nom_court',
        'capitale',
        'continent',
        'region',
        'code_iso2',
        'code_iso3',
        'indicatif_telephonique',
        'monnaie',
        'code_monnaie',
        'fuseau_horaire',
        'domaine_internet',
        'drapeau_url',
        'langue_officielle',
        'population',
        'superficie_km2',
        'latitude',
        'longitude',
    ];

    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}
