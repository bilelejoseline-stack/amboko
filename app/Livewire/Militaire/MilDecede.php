<?php

namespace App\Livewire\Militaire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Militaire;

class MilDecede extends Component
{
    use WithPagination;

    public $search = '';  // <-- propriété pour la recherche

    protected $paginationTheme = 'tailwind';

    // Pour reset la pagination quand la recherche change
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
      $milDcd = Militaire::where('statut', 'Décédé');

        $query = Militaire::where('statut', 'Décédé')
            ->where(function($q) {
                $q->where('matricule', 'like', "%{$this->search}%")
                  ->orWhere('nom', 'like', "%{$this->search}%")
                  ->orWhere('postnom', 'like', "%{$this->search}%")
                  ->orWhere('prenom', 'like', "%{$this->search}%");
            })
            ->orderBy('date_naissance', 'desc');

        $militaires = $query->paginate(10);
        $effectif = $milDcd->count();

        return view('livewire.militaire.mil-decede', compact('militaires', 'effectif'));
    }
}
