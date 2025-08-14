<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'content',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    /**
     * L'expéditeur du message.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    /**
     * Le destinataire du message.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id');
    }

    /**
     * Vérifie si le message a été lu.
     */
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    /**
     * Marque le message comme lu.
     */
    public function markAsRead()
    {
        if (!$this->isRead()) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Retourne une date lisible (facultatif mais utile).
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->translatedFormat('d M Y à H:i');
    }
}
