<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudeCivile extends Model
{
    use HasFactory;

    protected $fillable = [
        'militaire_id',
        'intitule',
        'etablissement',
        'lieu',
        'diplome',
        'mention',
        'date_debut',
        'date_fin',
        'annee_obtention',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'annee_obtention' => 'integer',
    ];

    // Relation : une étude civile appartient à un militaire
    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }

    // Accessor pour formater les dates (optionnel)
    public function getPeriodeEtudeAttribute()
    {
        $debut = $this->date_debut ? $this->date_debut->format('Y') : '?';
        $fin = $this->date_fin ? $this->date_fin->format('Y') : '?';
        return "$debut - $fin";
    }
}
