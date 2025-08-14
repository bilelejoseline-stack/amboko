<?php

namespace App\Livewire\Militaire;

use Livewire\Component;
use App\Models\Militaire;

class SearchMilitaires extends Component
{
    public $search = '';
    public $suggestions = [];

public function updatedSearch()
{
    if (strlen($this->search) > 0) {
        $this->suggestions = Militaire::query()
            ->where('nom', 'like', "%{$this->search}%")
            ->orWhere('postnom', 'like', "%{$this->search}%")
            ->orWhere('prenom', 'like', "%{$this->search}%")
            ->orWhere('matricule', 'like', "%{$this->search}%")
            ->orWhereHas('grade', function ($q) {
                $q->where('nom', 'like', "%{$this->search}%")
                  ->orWhere('abreviation', 'like', "%{$this->search}%");
            })
            ->with([
                'grade:id,abreviation',
            ])
            ->limit(8)
            ->get([
                'slug', 
                'nom', 
                'postnom', 
                'prenom', 
                'avatar', // avatar du militaire
                'grade_id'
            ]);
    } else {
        $this->suggestions = [];
    }
}


    public function render()
    {
        return view('livewire.militaire.search-militaires');
    }
}
