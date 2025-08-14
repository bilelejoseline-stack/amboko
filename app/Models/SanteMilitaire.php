<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SanteMilitaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'slug',
        'sous_titre',     // ➕ Ajout
        'description',    // ➕ Ajout
        'contenus',       // ➕ JSON complémentaire
        'image',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'contenus' => 'array', // Important : cast JSON pour Repeater
    ];

    /**
     * Booted method to handle slug generation and image cleanup.
     */
    protected static function booted()
    {
        // Générer automatiquement le slug lors de la création
        static::creating(function ($sante) {
            if (empty($sante->slug)) {
                $sante->slug = Str::slug($sante->titre);
            }
        });

        // Mettre à jour le slug si le titre change
        static::updating(function ($sante) {
            if ($sante->isDirty('titre')) {
                $sante->slug = Str::slug($sante->titre);
            }
        });

        // Supprimer l'image associée si le modèle est supprimé
        static::deleting(function ($sante) {
            if ($sante->image && Storage::disk('public')->exists('sante/' . $sante->image)) {
                Storage::disk('public')->delete('sante/' . $sante->image);
            }
        });
    }

    /**
     * Accesseur : URL complète de l'image
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::url('sante/' . $this->image) : null;
    }
}
