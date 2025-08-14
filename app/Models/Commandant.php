<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Commandant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'debut',
        'fin',
        'image',
        'titre',
        'description',
        'ordre',
        'actif',
    ];

    /**
     * Boot method pour attacher automatiquement les événements.
     */
    protected static function booted(): void
    {
        static::creating(function ($commandant) {
            $commandant->slug = static::generateSlug($commandant->titre);
        });

        static::updating(function ($commandant) {
            if ($commandant->isDirty('titre')) {
                $commandant->slug = static::generateSlug($commandant->titre);
            }
        });
    }

    /**
     * Génère un slug unique basé sur le titre.
     */
    protected static function generateSlug(string $titre): string
    {
        $baseSlug = Str::slug($titre);
        $slug = $baseSlug;
        $count = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        return $slug;
    }
}
