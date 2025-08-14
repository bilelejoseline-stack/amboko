<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reference',
        'objet',
        'description',
        'type_document',
        'date_document',
        'date_reception',
        'date_sortie',
        'provenance',
        'destinataire',
        'statut',
        'priorite',
        'mention',
        'observations',
        'fichier',
        'slug', // Slug inclus
    ];

    protected $casts = [
        'date_document'   => 'date',
        'date_reception'  => 'date',
        'date_sortie'     => 'date',
    ];

    /**
     * Génère automatiquement un slug unique lors de la création.
     */
    protected static function booted()
    {
        static::creating(function ($document) {
            $slugBase = $document->reference ?? Str::random(6);
            $slug = Str::slug($slugBase);
            $originalSlug = $slug;
            $counter = 1;

            while (self::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            $document->slug = $slug;
        });

        static::updating(function ($document) {
            if ($document->isDirty('reference')) {
                $slugBase = $document->reference ?? Str::random(6);
                $slug = Str::slug($slugBase);
                $originalSlug = $slug;
                $counter = 1;

                while (self::where('slug', $slug)->where('id', '!=', $document->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }

                $document->slug = $slug;
            }
        });
    }

    /**
     * Relation avec l'utilisateur qui a créé le document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Recherche d'un document par son slug.
     */
    public static function findBySlugOrFail(string $slug): self
    {
        return self::where('slug', $slug)->firstOrFail();
    }

    /**
     * Route personnalisée pour le modèle (optionnel : décommentez si vous voulez que Laravel utilise le slug partout).
     */
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
