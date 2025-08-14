<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'pays_id',
        'nom',
        'chef_lieu',
        'region',
        'population',
        'superficie_km2',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'population' => 'integer',
        'superficie_km2' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    // 🔗 Relation : une province appartient à un pays
    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    // Optionnel : Accessor pour afficher un résumé
    public function getResumeAttribute()
    {
        return "{$this->nom} ({$this->chef_lieu}) - {$this->population} habitants";
    }
}
