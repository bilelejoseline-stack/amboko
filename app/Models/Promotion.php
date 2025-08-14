<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'militaire_id',
        'grade_id',
        'date_promotion',
        'decision_numero',
        'commentaire',
    ];

    // Cast pour formater automatiquement la date
    protected $casts = [
        'date_promotion' => 'date',
    ];

    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
