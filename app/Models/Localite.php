<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'type',
        'chef_local',
        'population',
        'superficie_km2',
        'latitude',
        'longitude',
        'collectivite_id',
    ];

    protected $casts = [
        'population' => 'integer',
        'superficie_km2' => 'float',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * Une localité appartient à une collectivité.
     */
    public function collectivite()
    {
        return $this->belongsTo(Collectivite::class);
    }

    /**
     * Accesseur : nom complet avec type.
     */
    public function getNomCompletAttribute()
    {
        return "{$this->type} de {$this->nom}";
    }
}
