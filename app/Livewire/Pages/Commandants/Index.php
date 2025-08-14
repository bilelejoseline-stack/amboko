<?php

namespace App\Livewire\Pages\Commandants;

use App\Models\Commandant;
use Livewire\Component;

class Index extends Component
{
    public $commandants;

    public function mount()
    {
        $this->commandants = Commandant::where('actif', true)
            ->orderBy('ordre')
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.commandants.index')
            ->title('Commandants Suprêmes des FARDC');
    }
}
