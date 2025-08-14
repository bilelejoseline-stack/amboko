<?php

namespace App\Livewire\Militaire;

use Livewire\Component;
use App\Models\Militaire;

class MilWiki extends Component
{
    public $militaireId;
    public $militaire;

    public function mount($militaireId)
    {
        $this->militaireId = $militaireId;

        // Chargement avec relations, en mode défensif
        $this->militaire = Militaire::with([
            'grade',
            'promotions.grade',
            'affectations',
            'specialites',
            'etudesCiviles',
            'etudesMilitaires',
            'paies',
            'enfants',
            'historiques'
        ])->findOrFail($militaireId);
    }

    public function render()
    {
        return view('livewire.militaire.mil-wiki', [
            'militaire' => $this->militaire  // transmission explicite à la vue
        ]);
    }
}
