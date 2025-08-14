<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

class ChatNotification extends Component
{
    public function render()
    {
        // Invitations reçues par l'utilisateur connecté
        $requests = Friendship::with('sender')
            ->where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('livewire.chat.chat-notification', [
            'requests' => $requests,
            'count' => $requests->count(),
        ]);
    }

    public function accept($id)
    {
        $invite = Friendship::findOrFail($id);
        $invite->update(['status' => 'accepted']);
    }

    public function decline($id)
    {
        $invite = Friendship::findOrFail($id);
        $invite->update(['status' => 'declined']);
    }
}
