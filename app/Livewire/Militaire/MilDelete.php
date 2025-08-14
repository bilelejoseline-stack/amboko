<?php

namespace App\Livewire\Militaire;

use App\Models\Militaire;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class MilDelete extends Component
{
    public $militaire;

    public function mount($slug)
    {
        $this->militaire = Militaire::where('slug', $slug)->firstOrFail();
    }

    public function delete()
    {
        $nom = $this->militaire->nom_complet;

        $this->militaire->delete();

        Session::flash('success', "Le militaire $nom a été supprimé avec succès.");

        return redirect()->route('mil.list');
    }

    public function render()
    {
        return view('livewire.militaire.mil-delete'); // Adapter selon votre layout
    }
}
