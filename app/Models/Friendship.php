<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
        'accepted_at',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    // 🔗 Expéditeur de la demande
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // 🔗 Récepteur de la demande
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * ✅ Vérifie s'il existe déjà une demande d'amitié entre deux utilisateurs.
     * Cela empêche l'envoi de plusieurs invitations en double.
     */
    public static function hasPendingRequest($userA, $userB): bool
    {
        return self::where(function ($query) use ($userA, $userB) {
                $query->where('sender_id', $userA)
                      ->where('receiver_id', $userB);
            })
            ->orWhere(function ($query) use ($userA, $userB) {
                $query->where('sender_id', $userB)
                      ->where('receiver_id', $userA);
            })
            ->where('status', 'pending')
            ->exists();
    }

    /**
     * Retourne vrai si l'amitié est acceptée.
     */
    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }
}
