<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Champs modifiables en masse
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'code',           // code secret hashé
        'role',
        'militaire_id',   // si un user peut pointer vers un militaire
        'is_active',
    ];

    /**
     * Champs cachés dans les exports
     */
    protected $hidden = [
        'password',
        'remember_token',
        'code',
    ];

    /**
     * Casts automatiques
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ================= Relations =================

    /**
     * Lien direct : si `users` a une colonne militaire_id
     */
    public function militaire()
    {
        return $this->belongsTo(Militaire::class, 'militaire_id');
    }

    /**
     * Lien inverse : si `militaires` a une colonne user_id
     * (permet de retrouver le militaire profil d’un utilisateur)
     */
    public function militaireProfil()
    {
        return $this->hasOne(Militaire::class, 'user_id');
    }

    /**
     * Relation vers grade (optionnelle)
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // ================= Amis & relations =================

    public function sentRequests()
    {
        return $this->hasMany(Friendship::class, 'sender_id');
    }

    public function receivedRequests()
    {
        return $this->hasMany(Friendship::class, 'receiver_id');
    }

    public function hasSentRequestTo($userId): bool
    {
        return $this->sentRequests()
            ->where('receiver_id', $userId)
            ->where('status', 'pending')
            ->exists();
    }

    public function hasReceivedRequestFrom($userId): bool
    {
        return $this->receivedRequests()
            ->where('sender_id', $userId)
            ->where('status', 'pending')
            ->exists();
    }

    public function friendsFromSent()
    {
        return $this->hasMany(Friendship::class, 'sender_id')
            ->where('status', 'accepted');
    }

    public function friendsFromReceived()
    {
        return $this->hasMany(Friendship::class, 'receiver_id')
            ->where('status', 'accepted');
    }

    public function allFriends()
    {
        $sent = $this->friendsFromSent()->pluck('receiver_id');
        $received = $this->friendsFromReceived()->pluck('sender_id');

        return self::whereIn('id', $sent->merge($received))->get();
    }

    public function isFriendWith($userId): bool
    {
        return Friendship::where(function ($query) use ($userId) {
            $query->where('sender_id', $this->id)
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $this->id);
        })->where('status', 'accepted')->exists();
    }

    // ================= Accessors =================

    /**
     * Nom complet à partir du militaire lié
     */
    public function getNomCompletAttribute()
    {
        if ($this->militaire) {
            return $this->militaire->nom_complet; // utilise l'accesseur du modèle Militaire
        }
        if ($this->militaireProfil) {
            return $this->militaireProfil->nom_complet;
        }
        return $this->name; // fallback
    }

    // ================= Recherche =================

    public static function search($query)
    {
        return static::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhereHas('militaire', function ($q) use ($query) {
                $q->where('matricule', 'like', "%{$query}%")
                  ->orWhere('nom', 'like', "%{$query}%")
                  ->orWhere('postnom', 'like', "%{$query}%")
                  ->orWhere('prenom', 'like', "%{$query}%");
            })
            ->orWhereHas('militaireProfil', function ($q) use ($query) {
                $q->where('matricule', 'like', "%{$query}%")
                  ->orWhere('nom', 'like', "%{$query}%")
                  ->orWhere('postnom', 'like', "%{$query}%")
                  ->orWhere('prenom', 'like', "%{$query}%");
            });
    }

    // ================= Mutators =================

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] =
            Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] =
            Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    // ================= Rôles =================

    public function estAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function estMilitaire(): bool
    {
        return $this->role === 'militaire';
    }
}
