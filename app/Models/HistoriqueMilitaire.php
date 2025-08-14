<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueMilitaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'militaire_id',
        'type_evenement',
        'description',
        'date_evenement',
        'lieu',
        'reference_document',
    ];

    protected $casts = [
        'date_evenement' => 'date',
    ];


    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }
}
