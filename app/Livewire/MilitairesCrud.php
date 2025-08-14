<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Militaire;
use App\Models\Enfant;
use App\Models\Grade;
use Illuminate\Support\Facades\Storage;

class MilitairesCrud extends Component
{
    use WithFileUploads;

    public $militaire = [
        'matricule' => '',
        'nom' => '',
        'postnom' => '',
        'prenom' => '',
        'grade_id' => '',
        'fonction' => '',
        'unite' => '',
        'date_incorporation' => '',
        'lieu_incorporation' => '',
        'date_naissance' => '',
        'lieu_naissance' => '',
        'sexe' => '',
        'etat_civil' => '',
        'epouse' => '',
        'papa' => '',
        'maman' => '',
        'province' => '',
        'district' => '',
        'territoire' => '',
        'collectivite' => '',
        'localite' => '',
        'statut' => '',
        'code' => '',
        'adresse' => '',
        'telephone' => '',
        'avatar' => null,
    ];

    public $enfants = [];

    public function addEnfant()
    {
        $this->enfants[] = [
            'nom' => '',
            'postnom' => '',
            'prenom' => '',
            'date_naissance' => '',
            'lieu_naissance' => '',
            'sexe' => '',
        ];
    }

    public function removeEnfant($index)
    {
        unset($this->enfants[$index]);
        $this->enfants = array_values($this->enfants);
    }

    public function save()
    {
        $validated = $this->validate([
            'militaire.matricule' => 'required|unique:militaires,matricule',
            'militaire.nom' => 'required',
            'militaire.postnom' => 'required',
            'militaire.prenom' => 'required',
            'militaire.grade_id' => 'required|exists:grades,id',
            'militaire.fonction' => 'required',
            'militaire.unite' => 'required',
            'militaire.date_incorporation' => 'required|date',
            'militaire.lieu_incorporation' => 'required',
            'militaire.date_naissance' => 'required|date',
            'militaire.lieu_naissance' => 'required',
            'militaire.sexe' => 'required|in:M,F',
            'militaire.etat_civil' => 'nullable',
            'militaire.epouse' => 'nullable',
            'militaire.papa' => 'required',
            'militaire.maman' => 'required',
            'militaire.province' => 'nullable',
            'militaire.district' => 'nullable',
            'militaire.territoire' => 'nullable',
            'militaire.collectivite' => 'nullable',
            'militaire.localite' => 'nullable',
            'militaire.statut' => 'required',
            'militaire.code' => 'required|unique:militaires,code',
            'militaire.adresse' => 'nullable',
            'militaire.telephone' => 'nullable',
            'militaire.avatar' => 'nullable|image|max:1024',
        ]);

        if ($this->militaire['avatar']) {
            $path = $this->militaire['avatar']->store('avatars', 'public');
            $this->militaire['avatar'] = $path;
        } else {
            unset($this->militaire['avatar']);
        }

        $militaire = Militaire::create($this->militaire);

        foreach ($this->enfants as $data) {
            $data['militaire_id'] = $militaire->id;
            Enfant::create($data);
        }

        session()->flash('success', 'Militaire ajouté avec succès !');

        $this->reset(['militaire', 'enfants']);
    }

    public function render()
    {
        return view('livewire.militaires-crud', [
            'grades' => Grade::orderBy('nom_grade')->get(),
        ]);
    }
}
