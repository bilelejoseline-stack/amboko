<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatBodyMessages extends Component
{
    public $userId; // Ami sélectionné
    public $messages = [];

    protected $listeners = [
        'messageSent' => 'handleNewMessage',
        'userSelected' => 'setUser',
    ];

    public function mount($userId = null)
    {
        $this->userId = $userId;
        if ($userId) {
            $this->loadMessages();
            $this->markMessagesAsRead();
        }
    }

    public function setUser($userId)
    {
        $this->userId = $userId;
        $this->loadMessages();
        $this->markMessagesAsRead();
    }

    public function loadMessages()
    {
        $userId = Auth::id();

        $this->messages = Message::with('sender')
            ->where(function ($query) use ($userId) {
                $query->where('from_id', $userId)
                      ->orWhere('to_id', $userId);
            })
            ->where(function ($query) {
                $query->where('from_id', $this->userId)
                      ->orWhere('to_id', $this->userId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function markMessagesAsRead()
    {
        $userId = Auth::id();

        Message::where('from_id', $this->userId)
            ->where('to_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function handleNewMessage()
    {
        $this->loadMessages();
        $this->markMessagesAsRead();
    }

    public function render()
    {
        return view('livewire.chat.chat-body-messages');
    }
}
