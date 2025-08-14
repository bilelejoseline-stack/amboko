<?php

namespace App\Livewire\Chat;
// app/Livewire/Chat/ChatUtilisateurs.php


use Livewire\Component;
use App\Models\User;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;

class ChatUtilisateurs extends Component
{
    public $search = '';
    public $users = [];

    public function mount()
    {
        $this->loadUsers();
    }

    public function updatedSearch()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::where('id', '!=', Auth::id())
            ->where(function($query) {
                $query->where('name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->get();
    }

    public function sendInvitation($userId)
    {
        $already = Friendship::where('sender_id', Auth::id())
            ->where('receiver_id', $userId)
            ->first();

        if (!$already) {
            Friendship::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $userId,
                'status' => 'pending',
            ]);
            session()->flash('message', '✅ Invitation envoyée.');
        } else {
            session()->flash('message', '⚠️ Invitation déjà envoyée ou utilisateur déjà ami.');
        }

        $this->loadUsers(); // Recharge la liste avec le nouveau statut
    }

    public function render()
    {
        return view('livewire.chat.chat-utilisateurs');
    }
}
