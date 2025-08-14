<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collectivite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',  // chefferie ou secteur
        'territoire_id',
        'chef_lieu',
        'population',
        'superficie_km2',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'population' => 'integer',
        'superficie_km2' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * 🔗 Relation inverse : cette collectivité appartient à un territoire
     */
    public function territoire()
    {
        return $this->belongsTo(Territoire::class);
    }

    /**
     * 🗺️ Nom complet avec territoire (utile pour affichage)
     */
    public function getNomCompletAttribute()
    {
        return "{$this->type} de {$this->nom}, Territoire de {$this->territoire->nom}";
    }
}
