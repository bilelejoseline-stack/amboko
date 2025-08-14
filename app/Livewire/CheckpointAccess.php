<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CheckpointAccess extends Component
{
    // Propriété publique liée à l’input du code d’accès dans la vue Livewire
    public $code = '';

    // Règles de validation pour la propriété $code
    protected $rules = [
        'code' => 'required|string|min:4',  // Code obligatoire, chaîne, au moins 4 caractères
    ];

    // Méthode appelée automatiquement avant tout rendu du composant
    public function mount()
    {
        // Si la session PHP contient déjà le flag "checkpoint_passed" à true,
        // cela veut dire que le visiteur a déjà validé le checkpoint,
        // donc on le redirige directement vers la page 'home' sans refaire la vérification
        if (session()->has('checkpoint_passed') && session('checkpoint_passed') === true) {
            return redirect()->route('home');
        }
    }

    // Méthode appelée quand le formulaire est soumis (wire:submit.prevent="checkCode")
    public function checkCode()
    {
        // Valide le champ $code selon les règles définies plus haut
        $this->validate();

        // Récupère tous les utilisateurs qui ont un code d’accès non nul
        $users = User::whereNotNull('code')->get();

        // Cherche parmi les utilisateurs celui dont le code hashé correspond au code saisi
        $matchedUser = $users->first(function ($user) {
            return Hash::check($this->code, $user->code);
        });

        // Si un utilisateur correspond au code saisi
        if ($matchedUser) {
            // Stocke dans la session PHP un flag "checkpoint_passed" à true,
            // qui sert à dire que ce visiteur a passé le checkpoint avec succès
            session(['checkpoint_passed' => true]);

            // Redirige vers la route 'home' (page d’accueil ou tableau de bord)
            return redirect()->route('home');
        }

        // Si aucun utilisateur ne correspond au code, ajoute une erreur de validation
        $this->addError('code', 'Code incorrect — accès refusé.');
    }

    // Méthode qui retourne la vue Livewire associée, avec mise en page spécifique
    public function render()
    {
        // Affiche la vue blade livewire.checkpoint-access
        // avec le layout components.layouts.auth (page d’authentification)
        return view('livewire.checkpoint-access')->layout('components.layouts.auth');
    }
}
