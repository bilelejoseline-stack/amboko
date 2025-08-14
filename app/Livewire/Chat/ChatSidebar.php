<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class ChatSidebar extends Component
{
    public $activeTab = 'users';

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.chat.chat-sidebar');
    }
}
