<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territoire extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'district_id',
        'chef_lieu',
        'population',
        'superficie_km2',
        'latitude',
        'longitude',
    ];

    // Casts pour le bon format des données
    protected $casts = [
        'population' => 'integer',
        'superficie_km2' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Relation inverse : territoire appartient à un district
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Accesseur : nom avec chef-lieu
     */
    public function getNomCompletAttribute()
    {
        return "{$this->nom} ({$this->chef_lieu})";
    }

    /**
     * Scope : pour filtrer par province via le district
     */
    public function scopeDeProvince($query, $provinceId)
    {
        return $query->whereHas('district', function ($q) use ($provinceId) {
            $q->where('province_id', $provinceId);
        });
    }
}
