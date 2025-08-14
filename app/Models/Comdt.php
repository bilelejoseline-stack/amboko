<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Comdt extends Model
{
  use HasFactory;

    protected $table = 'comdts';

    /**
     * Attributs autorisés pour remplissage en masse.
     */
    protected $fillable = [
        'titre',
        'image',
        'slug',
        'debut_annee',
        'fin_annee',
        'citation',
        'contenus',
    ];

    /**
     * Définir les types de certains champs.
     */
    protected $casts = [
        'contenus' => 'array',
        'debut_annee' => 'integer',
        'fin_annee' => 'integer',
    ];

    /**
     * Événements du modèle : auto-générer le slug.
     */
    protected static function booted()
    {
        static::creating(function ($comdt) {
            $comdt->slug = Str::slug($comdt->titre);
        });

        static::updating(function ($comdt) {
            $comdt->slug = Str::slug($comdt->titre);
        });
    }

    /**
     * Permet de récupérer l'URL du fichier image complet.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
