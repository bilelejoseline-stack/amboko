<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatBodyInput extends Component
{
    public $userId;      // ID du destinataire
    public $message = ''; // Texte du message

    protected $rules = [
        'message' => 'required|string|max:1000',
    ];

    public function sendMessage()
    {
        $this->validate();

        Message::create([
            'from_id' => Auth::id(),
            'to_id'   => $this->userId,
            'content' => $this->message,
        ]);

        $this->reset('message');    // Vide le champ input
        $this->dispatch('messageSent');  // Événement Livewire 3
    }

    public function render()
    {
        return view('livewire.chat.chat-body-input');
    }
}
