<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;
use App\Models\Friendship;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatList extends Component
{
    public $search = '';

    public function getFriends()
    {
        $userId = Auth::id();

        // Récupérer les IDs d'amis confirmés
        $friendIds = Friendship::where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->get()
            ->map(function ($friendship) use ($userId) {
                return $friendship->sender_id === $userId
                    ? $friendship->receiver_id
                    : $friendship->sender_id;
            });

        // Rechercher par nom ou email
        $friends = User::whereIn('id', $friendIds)
            ->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->get();

        // Pour chaque ami, on ajoute :
        foreach ($friends as $friend) {
            // ➤ Nombre de messages non lus reçus de cet ami
            $friend->unread_count = Message::where('from_id', $friend->id)
                ->where('to_id', $userId)
                ->whereNull('read_at')
                ->count();

            // ➤ Dernier message échangé avec cet ami
            $friend->last_message = Message::where(function ($query) use ($userId, $friend) {
                    $query->where('from_id', $userId)->where('to_id', $friend->id)
                          ->orWhere('from_id', $friend->id)->where('to_id', $userId);
                })
                ->latest('created_at')
                ->first();
        }

        return $friends;
    }

    public function selectFriend($friendId)
    {
        $this->dispatch('userSelected', $friendId);
    }


    public function updatedSearch($value)
{
    // Nettoyage de l'entrée (facultatif)
    $this->search = trim($value);

    // Vous pouvez ici déclencher une logique supplémentaire, par exemple :
    // - journalisation
    // - chargement conditionnel
    // - rafraîchissement d'autres propriétés

    // Exemple : forcer le rafraîchissement des amis (utile si c'était une propriété cache)
    $this->dispatch('$refresh'); // Si besoin de re-render forcé
}


    public function render()
    {
        return view('livewire.chat.chat-list', [
            'friends' => $this->getFriends(),
        ]);
    }
}
