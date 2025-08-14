<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;

class DocumentsEdit extends Component
{
    use WithFileUploads;

    public $document;
    public $reference, $objet, $type_document;
    public $date_document, $date_reception, $date_sortie;
    public $provenance, $description, $destinataire, $statut, $priorite;
    public $mention, $observations;
    public $form = ['fichier' => null];

    public function mount($slug)
    {
        $this->document = Document::where('slug', $slug)->firstOrFail();

        // Pré-remplir les champs
        $this->reference = $this->document->reference;
        $this->objet = $this->document->objet;
        $this->type_document = $this->document->type_document;
        $this->date_document = $this->document->date_document;
        $this->date_reception = $this->document->date_reception;
        $this->date_sortie = $this->document->date_sortie;
        $this->provenance = $this->document->provenance;
        $this->description = $this->document->description;
        $this->destinataire = $this->document->destinataire;
        $this->statut = $this->document->statut;
        $this->priorite = $this->document->priorite;
        $this->mention = $this->document->mention;
        $this->observations = $this->document->observations;
    }

    protected $rules = [
        'reference' => 'required|string|max:255',
        'objet' => 'required|string|max:255',
        'type_document' => 'required|string|max:100',
        'date_document' => 'nullable|date',
        'date_reception' => 'required|date',
        'date_sortie' => 'nullable|date',
        'provenance' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:1000',
        'destinataire' => 'nullable|string|max:1000',
        'statut' => 'required|string',
        'priorite' => 'required|string',
        'mention' => 'nullable|string|max:255',
        'observations' => 'nullable|string',
        'form.fichier' => 'nullable|file|max:10240',
    ];

    public function update()
    {
        $this->validate();

        // Si un nouveau fichier est uploadé
        if ($this->form['fichier']) {
            $fichierNom = $this->form['fichier']->store('documents', 'public');
            $this->document->fichier = $fichierNom;
        }

        // Mise à jour des données
        $this->document->update([
            'reference' => $this->reference,
            'objet' => $this->objet,
            'type_document' => $this->type_document,
            'date_document' => $this->date_document,
            'date_reception' => $this->date_reception,
            'date_sortie' => $this->date_sortie,
            'provenance' => $this->provenance,
            'description' => $this->description,
            'destinataire' => $this->destinataire,
            'statut' => $this->statut,
            'priorite' => $this->priorite,
            'mention' => $this->mention,
            'observations' => $this->observations,
        ]);

        session()->flash('message', 'Document mis à jour avec succès.');

        return redirect()->route('documents.index');
    }

    public function render()
    {
        return view('livewire.pages.documents-edit');
    }
}
