<?php

namespace App\Livewire\Superadmin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.superadmin.dashboard')->layout('components.layouts.dashboard');
    }
}
