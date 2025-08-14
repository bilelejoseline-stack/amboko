<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    use HasFactory;

    protected $fillable = [
        'militaire_id',
        'poste',
        'unite',
        'date_debut',
        'date_fin',
        'commentaires',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    // Relation inverse : une affectation appartient à un militaire
    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }
}
