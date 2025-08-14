<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Hero;

class Heros extends Component
{
    public $heroes = [];

    public function mount()
    {
        // Récupérer uniquement les héros actifs
        $this->heroes = Hero::where('active', true)->get(['image', 'title', 'subtitle','description']);
    }

    public function render()
    {
        return view('livewire.pages.heros');
    }
}
