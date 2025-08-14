<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cemg extends Model
{
    /** @use HasFactory<\Database\Factories\CemgFactory> */
    use HasFactory;

    protected $fillable = [
    'militaire_id',
    'name',
    'role_id',
    'description',
    'active',
    ];


    public function militaire()
    {
        return $this->belongsTo(Militaire::class);
    }

    public function role()
    {
        return $this->belongsTo(RoleCemg::class, 'role_id');
    }

}
