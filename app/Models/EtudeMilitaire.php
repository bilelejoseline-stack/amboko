<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudeMilitaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'militaire_id',
        'nom_etude',
        'institution',
        'pays',
        'date_debut',
        'date_fin',
        'annee_obtention',
        'titre',
        'description',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }
}
