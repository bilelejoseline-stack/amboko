<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    use HasFactory;

    // Champs remplissables en masse
    protected $fillable = [
        'title',
        'slug',
        'subtitles',       // ✅ Ajouté
        'descriptions',    // ✅ Ajouté
        'image',
        'video',           // ✅ Ajouté
        'active',
    ];

    // Casting : conversion JSON en array + active en bool
    protected $casts = [
        'subtitles'    => 'array',   // ✅ JSON → array
        'descriptions' => 'array',   // ✅ JSON → array
        'active'       => 'boolean',
    ];

    // Slug automatique à la création et mise à jour
    protected static function booted()
    {
        static::creating(function ($about) {
            $about->slug = Str::slug($about->title);
        });

        static::updating(function ($about) {
            $about->slug = Str::slug($about->title);
        });
    }
}
