<?php

namespace App\Livewire\Pages\Commandants;

use App\Models\Commandant;
use Livewire\Component;

class Show extends Component
{
    public Commandant $commandant;

    public function mount($slug)
    {
        $this->commandant = Commandant::where('slug', $slug)
            ->where('actif', true)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.pages.commandants.show')
            ->title($this->commandant->nom);
    }
}
