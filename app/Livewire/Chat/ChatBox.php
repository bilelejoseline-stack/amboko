<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;

class ChatBox extends Component
{
    public $selectedUser = null;

    protected $listeners = ['userSelected' => 'setUser'];

    public function setUser($userId)
    {
        $this->selectedUser = User::find($userId);
    }

    public function render()
    {
        return view('livewire.chat.chat-box');
    }
}
