<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfant extends Model
{
    /** @use HasFactory<\Database\Factories\EnfantFactory> */
    use HasFactory;

    // Champs autorisés à l'assignation en masse
    protected $fillable = [
        'militaire_id',
        'nom',
        'postnom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
    ];

    // Relation : chaque enfant appartient à un militaire
    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }

    // Accessor : nom complet de l'enfant
    public function getNomCompletAttribute(): string
    {
        return strtoupper("{$this->nom} {$this->postnom} {$this->prenom}");
    }

    // Cast de date automatique (utile pour le formatage)
    protected $casts = [
        'date_naissance' => 'date',
    ];
}
