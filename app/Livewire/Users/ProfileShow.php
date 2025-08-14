<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class ProfileShow extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.users.profile-show');
    }
}
