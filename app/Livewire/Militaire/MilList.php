<?php

namespace App\Livewire\Militaire;

use App\Models\Militaire;
use Livewire\Component;
use Livewire\WithPagination;

class MilList extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    // Réinitialiser la page si la recherche change
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Méthode de suppression d'un militaire
    public function delete($id)
    {
        $militaire = Militaire::findOrFail($id);
        $militaire->delete();

        session()->flash('success', 'Militaire supprimé avec succès.');
    }

    public function render()
    {
        $militaires = Militaire::query()
            ->where('nom', 'like', "%{$this->search}%")
            ->orWhere('postnom', 'like', "%{$this->search}%")
            ->orWhere('prenom', 'like', "%{$this->search}%")
            ->orWhere('matricule', 'like', "%{$this->search}%")
            ->orWhere('grade_id', 'like', "%{$this->search}%")
            ->with('grade')
            ->orderBy('nom')
            ->paginate(10);

        return view('livewire.militaire.mil-list', [
            'militaires' => $militaires,
        ]);
    }
}
