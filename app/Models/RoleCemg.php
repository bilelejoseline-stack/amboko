<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleCemg extends Model
{
    /** @use HasFactory<\Database\Factories\RoleCemgFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    public function cemg()
    {
        return $this->hasOne(Cemg::class, 'role_id');
    }
}
