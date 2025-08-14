<?php

namespace App\Livewire\Users\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Show extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.users.profile.show');
    }
}
