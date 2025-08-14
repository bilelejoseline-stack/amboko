<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'province_id',
        'chef_lieu',
        'population',
        'superficie_km2',
        'latitude',
        'longitude',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
