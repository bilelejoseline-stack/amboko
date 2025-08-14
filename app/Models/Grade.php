<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',                // Nom complet du grade (ex: Capitaine)
        'abreviation',        // Abréviation (ex: Cpt)
        'niveau_hierarchique',// Niveau (1: Soldat, 10: Général)
        'solde_base',         // Solde de base attribuée au grade
    ];

    // Casts pour les types de données
    protected $casts = [
        'solde_base' => 'float',
        'niveau_hierarchique' => 'integer',
    ];

    /**
     * Relation : Un grade est attribué à plusieurs militaires.
     */
    public function militaires()
    {
        return $this->hasMany(Militaire::class);
    }

    /**
     * Paies des militaires de ce grade (via hasManyThrough).
     */
    public function paies()
    {
        return $this->hasManyThrough(Paie::class, Militaire::class);
    }

    /**
     * Accessor : nom du grade en majuscule (optionnel).
     */
    public function getNomAttribute($value)
    {
        return strtoupper($value);
    }

    /**
     * Accessor : nom complet formaté avec abréviation (ex: Cpt - CAPITAINE)
     */
    public function getNomCompletAttribute()
    {
        return $this->abreviation
            ? "{$this->abreviation} - {$this->nom}"
            : $this->nom;
    }
}
