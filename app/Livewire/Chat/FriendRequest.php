<?php

namespace App\Livewire\Chat;

use App\Models\User;
use App\Models\Friendship;
use Livewire\Component;

class FriendRequest extends Component
{
    public $users;
    public $search = '';
    public $pendingRequests;
    public $receivedRequests;
    public $friends;

    public function mount()
    {
        $this->refreshAll();
    }

    public function updatedSearch()
    {
        $this->updateUsers();
    }

    public function sendRequest($receiverId)
    {
        if ($receiverId == auth()->id() || Friendship::hasPendingRequest(auth()->id(), $receiverId)) {
            $this->dispatch('toast', message: '⚠️ Invitation déjà envoyée ou invalide.');
            return;
        }

        Friendship::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        $this->dispatch('toast', message: '✅ Demande envoyée.');
        $this->refreshAll();
    }

    public function acceptRequest($requestId)
    {
        $request = Friendship::findOrFail($requestId);
        if ($request->receiver_id !== auth()->id()) {
            abort(403);
        }

        $request->update(['status' => 'accepted']);
        $this->dispatch('toast', message: '🤝 Demande acceptée.');
        $this->refreshAll();
    }

    public function rejectRequest($requestId)
    {
        $request = Friendship::findOrFail($requestId);
        if ($request->receiver_id !== auth()->id()) {
            abort(403);
        }

        $request->update(['status' => 'rejected']);
        $this->dispatch('toast', message: '❌ Demande refusée.');
        $this->refreshAll();
    }

    public function removeFriend($userId)
    {
        Friendship::where(function ($query) use ($userId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', auth()->id());
        })->delete();

        $this->dispatch('toast', message: '👋 Ami supprimé.');
        $this->refreshAll();
    }

    public function refreshAll()
    {
        $this->updateUsers();

        $this->pendingRequests = Friendship::where('sender_id', auth()->id())
            ->where('status', 'pending')
            ->with('receiver')
            ->get();

        $this->receivedRequests = Friendship::where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->with('sender')
            ->get();

        $this->friends = auth()->user()->allFriends();
    }

    public function updateUsers()
    {
        $this->users = User::where('id', '!=', auth()->id())
            ->whereDoesntHave('friendsFromSent', fn ($query) =>
                $query->where('receiver_id', auth()->id()))
            ->whereDoesntHave('friendsFromReceived', fn ($query) =>
                $query->where('sender_id', auth()->id()))
            ->where('name', 'like', "%{$this->search}%")
            ->get();
    }

    public function render()
    {
        return view('livewire.chat.friend-request');
    }
}
