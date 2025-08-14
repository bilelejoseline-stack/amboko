<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_specialite',
        'description',
    ];

    /**
     * Relation plusieurs-à-plusieurs avec les militaires
     */
    public function militaires()
    {
        return $this->belongsToMany(Militaire::class);
    }
}
