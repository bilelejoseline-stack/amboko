<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Team;

class Teams extends Component
{
    public $members = [];
    public $startIndex = 0;
    public $visibleCount = 3;

    protected $listeners = ['rotateTeam'];

    public function mount()
    {
        // Charge tous les membres actifs au départ
        $this->members = Team::where('active', true)->get()->toArray();
    }

    public function rotateTeam()
    {
        $total = count($this->members);
        if ($total === 0) return;

        // Décale l'index de départ pour afficher les membres suivants
        $this->startIndex = ($this->startIndex + 1) % $total;
    }

    public function render()
    {
        $visibleMembers = [];
        $total = count($this->members);

        if ($total === 0) {
            return view('livewire.pages.teams', ['visibleMembers' => []]);
        }

        for ($i = 0; $i < min($this->visibleCount, $total); $i++) {
            $index = ($this->startIndex + $i) % $total;
            $visibleMembers[] = $this->members[$index];
        }

        return view('livewire.pages.teams', [
            'visibleMembers' => $visibleMembers,
        ]);
    }
}
