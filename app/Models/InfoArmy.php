<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoArmy extends Model
{
    use HasFactory;

    /**
     * Table liée (optionnel si le nom est correct)
     */
    protected $table = 'info_armies';

    /**
     * Les champs qu’on peut remplir en masse (mass assignment)
     */
    protected $fillable = [
        'title',
        'message',
        'active',
        'priority',
    ];

    /**
     * Casts automatiques (important pour boolean)
     */
    protected $casts = [
        'active' => 'boolean',
    ];
}
