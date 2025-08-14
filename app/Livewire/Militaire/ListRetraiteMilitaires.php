<?php

namespace App\Livewire\Militaire;

use App\Models\Militaire;
use Livewire\Component;
use Livewire\WithPagination;

class ListRetraiteMilitaires extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind'; // Ou 'bootstrap' selon ta config

    // Réinitialiser la page à chaque recherche
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $currentYear = now()->year;

        $query = Militaire::with('grade')
            ->whereRaw("($currentYear - CAST(SUBSTRING(matricule, 1, 4) AS UNSIGNED)) >= 65");

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('matricule', 'like', "%{$this->search}%")
                  ->orWhere('nom', 'like', "%{$this->search}%")
                  ->orWhere('postnom', 'like', "%{$this->search}%")
                  ->orWhere('prenom', 'like', "%{$this->search}%")
                  ->orWhere('unite', 'like', "%{$this->search}%");
            });
        }

        $militaires = $query->orderBy('nom')->paginate(10);

        return view('livewire.militaire.list-retraite-militaires', [
            'militaires' => $militaires,
            'currentYear' => $currentYear,
        ]);
    }
}
