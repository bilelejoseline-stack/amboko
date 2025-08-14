<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Friendship;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ChatUsers extends Component
{
    public $search = '';
    public $pendingRequests = [];

    /**
     * Chargement automatique des invitations en attente à chaque rendu
     */
    public function hydrate()
    {
        $this->loadPendingRequests();
    }

    public function render()
    {
        $userId = Auth::id();

        // On récupère UNIQUEMENT les amis déjà confirmés
        $friendIds = Friendship::where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->orWhere('receiver_id', $userId);
            })
            ->where('status', 'accepted')
            ->get()
            ->flatMap(function ($friendship) use ($userId) {
                return $friendship->sender_id == $userId
                    ? [$friendship->receiver_id]
                    : [$friendship->sender_id];
            })
            ->unique()
            ->toArray();

        // Requête utilisateurs disponibles pour invitation
        $users = User::query()
            ->where('id', '!=', $userId)
            ->whereNotIn('id', $friendIds)
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('username', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.chat.chat-users', compact('users'));
    }

    /**
     * Envoyer une demande d'amitié
     */
     public function sendRequest($receiverId)
     {
         $userId = Auth::id();

         Friendship::firstOrCreate([
             'sender_id' => $userId,
             'receiver_id' => $receiverId,
         ], [
             'status' => 'pending',
         ]);

         $this->loadPendingRequests();

         $this->dispatch('refreshChatList')->to('chat.chat-list');

         $this->dispatch('notify', ['message' => "Invitation envoyée !"]);
     }



    /**
     * Annuler une demande d'amitié
     */
    public function cancelRequest($receiverId)
    {
        Friendship::where('sender_id', Auth::id())
            ->where('receiver_id', $receiverId)
            ->where('status', 'pending')
            ->delete();

        $this->loadPendingRequests();
    }

    /**
     * Chargement des invitations en attente
     */
    public function loadPendingRequests()
    {
        $this->pendingRequests = Friendship::where('sender_id', Auth::id())
            ->where('status', 'pending')
            ->pluck('receiver_id')
            ->toArray();
    }

    /**
     * Rafraîchissement manuel via événement Livewire
     */
    #[On('refreshChatUsers')]
    public function refreshComponent()
    {
        $this->loadPendingRequests();
    }
}
