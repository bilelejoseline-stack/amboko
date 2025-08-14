<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    // Champs assignables en masse
    protected $fillable = [
        'name',
        'slug',
        'role',
        'avatar',
        'bio',
        'active',
    ];

    // Cast automatique des champs
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Mutator pour générer automatiquement le slug depuis le nom,
     * si slug non défini.
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        if (! $this->exists || empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }
}
