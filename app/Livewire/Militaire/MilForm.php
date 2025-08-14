<?php

namespace App\Livewire\Militaire;

use App\Models\Militaire;
use App\Models\Enfant;
use App\Models\Grade;
use Livewire\Component;
use Illuminate\Support\Str;


class MilForm extends Component
{
    public $matricule, $nom, $postnom, $prenom, $grade_id, $fonction, $unite, $date_incorporation, $lieu_incorporation;
    public $date_naissance, $lieu_naissance, $sexe, $etat_civil;
    public $epouse, $papa, $maman, $province, $district, $territoire;
    public $collectivite, $localite, $statut, $code, $adresse, $telephone;

    public $enfants = [];

    public function mount()
    {
        // Initialiser avec un enfant vide
        $this->enfants[] = [
            'nom' => '',
            'postnom' => '',
            'prenom' => '',
            'date_naissance' => '',
        ];
    }

    public function addEnfant()
    {
        $this->enfants[] = [
            'nom' => '',
            'postnom' => '',
            'prenom' => '',
            'date_naissance' => '',
        ];
    }

    public function removeEnfant($index)
    {
        unset($this->enfants[$index]);
        $this->enfants = array_values($this->enfants); // Réindexer
    }


    public function save()
    {
        $validated = $this->validate([
            'matricule' => 'required|string|max:20',
            'nom' => 'required|string',
            'postnom' => 'required|string',
            'prenom' => 'required|string',
            'grade_id' => 'required|exists:grades,id',
            'fonction' => 'nullable|string',
            'unite' => 'required|string',
            'date_incorporation' => 'required|string',
            'lieu_incorporation' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'sexe' => 'required|string',
            'etat_civil' => 'required|string',
            'epouse' => 'nullable|string',
            'papa' => 'required|string',
            'maman' => 'required|string',
            'province' => 'required|string',
            'district' => 'required|string',
            'territoire' => 'required|string',
            'collectivite' => 'required|string',
            'localite' => 'required|string',
            'statut' => 'nullable|string',
            'code' => 'nullable|string',
            'adresse' => 'required|string',
            'telephone' => 'nullable|string',
            'enfants.*.nom' => 'nullable|string',
            'enfants.*.postnom' => 'nullable|string',
            'enfants.*.prenom' => 'nullable|string',
            'enfants.*.date_naissance' => 'nullable|date',
        ]);

        // Génération de l'URL avatar UI Avatars
        $avatarUrl = 'https://ui-avatars.com/api/?name=' .
            urlencode($this->prenom . ' ' . $this->nom) .
            '&background=0D8ABC&color=fff';

        // Téléchargement de l'image
        $avatarContent = file_get_contents($avatarUrl);

        // Création d'un nom de fichier unique
        $fileName = Str::slug($this->prenom . '-' . $this->nom) . '-' . time() . '.png';

        // Chemin complet dans public/militaires/images
        $savePath = public_path('militaires/images/' . $fileName);

        // Sauvegarde du fichier image
        file_put_contents($savePath, $avatarContent);

        // Création de la ressource Militaire avec chemin relatif de l'avatar
        $militaire = Militaire::create([
            'matricule' => $this->matricule,
            'nom' => $this->nom,
            'postnom' => $this->postnom,
            'prenom' => $this->prenom,
            'grade_id' => $this->grade_id,
            'fonction' => $this->fonction,
            'unite' => $this->unite,
            'date_incorporation' => $this->date_incorporation,
            'lieu_incorporation' => $this->lieu_incorporation,
            'date_naissance' => $this->date_naissance,
            'lieu_naissance' => $this->lieu_naissance,
            'sexe' => $this->sexe,
            'etat_civil' => $this->etat_civil,
            'epouse' => $this->epouse,
            'papa' => $this->papa,
            'maman' => $this->maman,
            'province' => $this->province,
            'district' => $this->district,
            'territoire' => $this->territoire,
            'collectivite' => $this->collectivite,
            'localite' => $this->localite,
            'statut' => $this->statut,
            'code' => $this->code,
            'adresse' => $this->adresse,
            'telephone' => $this->telephone,
            'avatar' => 'militaires/images/' . $fileName, // chemin relatif pour <img src>
        ]);

        // Création des enfants liés
        foreach ($this->enfants as $enfant) {
            $militaire->enfants()->create($enfant);
        }

        session()->flash('success', 'Militaire et enfants enregistrés.');
        return redirect()->route('militaires.index');
    }

    public function render()
    {
        return view('livewire.militaire.mil-form', [
            'grades' => Grade::all(),
        ]);
    }
}
