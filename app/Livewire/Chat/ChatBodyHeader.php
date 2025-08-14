<?php

namespace App\Livewire\Chat;

use Livewire\Component;
use App\Models\User;

class ChatBodyHeader extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.chat.chat-body-header');
    }
}
