<?php

namespace App\Livewire\Militaire;

use App\Models\Militaire;
use Livewire\Component;

class MilEdit extends Component
{
    public $militaireId;
    public $militaire;

    // Champs à éditer
    public $matricule, $nom, $postnom, $prenom, $grade_id, $fonction, $unite, $statut;

    public function mount($slug)
    {
        $this->militaire = Militaire::where('slug', $slug)->firstOrFail();
        $this->militaireId = $this->militaire->id;

        // Remplir les champs
        $this->matricule = $this->militaire->matricule;
        $this->nom = $this->militaire->nom;
        $this->postnom = $this->militaire->postnom;
        $this->prenom = $this->militaire->prenom;
        $this->grade_id = $this->militaire->grade_id;
        $this->fonction = $this->militaire->fonction;
        $this->unite = $this->militaire->unite;
        $this->statut = $this->militaire->statut;
    }


    public function update()
    {
        $this->validate([
            'matricule' => 'required|string|max:20',
            'nom' => 'required|string',
            'postnom' => 'required|string',
            'prenom' => 'required|string',
            'grade_id' => 'required|exists:grades,id',
            'fonction' => 'nullable|string',
            'unite' => 'nullable|string',
            'statut' => 'required|string',
        ]);

        $this->militaire->update([
            'matricule' => $this->matricule,
            'nom' => $this->nom,
            'postnom' => $this->postnom,
            'prenom' => $this->prenom,
            'grade_id' => $this->grade_id,
            'fonction' => $this->fonction,
            'unite' => $this->unite,
            'statut' => $this->statut,
        ]);

        session()->flash('success', 'Militaire mis à jour avec succès.');

        return redirect()->route('militaires.show', $this->militaireId);
    }

    public function render()
    {
        return view('livewire.militaire.mil-edit');
    }
}
