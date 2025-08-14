<?php

namespace App\Livewire\Militaire;

use App\Models\Militaire;
use Livewire\Component;

class MilShow extends Component
{
    public Militaire $militaire;

    public function mount(string $slug): void
    {
        $this->militaire = Militaire::with([
            'grade',
            'user',
            'enfants',
            'paies',
            'promotions',
            'affectations',
            'specialites',
            'etudesCiviles',
            'etudesMilitaires',
            'historiques',
            'province', 'district', 'territoire', 'collectivite', 'localite',
        ])->where('slug', $slug)->firstOrFail();
    }

    public function delete($id)
    {
        try {
            $militaire = Militaire::findOrFail($id);
            $nom = $militaire->nom_complet;
            $militaire->delete();

            // Envoi d’un événement Livewire pour succès
            $this->dispatch('toastr', [
                'type' => 'success',
                'message' => "$nom supprimé avec succès."
            ]);

            return redirect()->route('mil.list');

        } catch (\Exception $e) {
            $this->dispatch('toastr', [
                'type' => 'error',
                'message' => "Erreur lors de la suppression : " . $e->getMessage()
            ]);
        }
    }



    public function render()
    {
        return view('livewire.militaire.mil-show')
            ->title("Fiche - {$this->militaire->nom_complet}");
    }
}
