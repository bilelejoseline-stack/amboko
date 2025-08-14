<?php

namespace App\Livewire\Pages;

use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class RegisterDocument extends Component
{
    use WithFileUploads;

    // Propriétés pour le formulaire
    public $documentId;
    public $reference;
    public $objet;
    public $description;
    public $type_document;
    public $date_document;
    public $date_reception;
    public $date_sortie;
    public $provenance;
    public $destinataire;
    public $statut = 'Enregistré';
    public $priorite = 'Normale';
    public $mention;
    public $observations;
    public $fichier;
    public $slug;

    public $existingDocument;

    public function mount($slug = null)
    {
        if ($slug) {
            $this->existingDocument = Document::where('slug', $slug)->firstOrFail();
            $this->loadDocumentData();
        }
    }

    protected function loadDocumentData()
    {
        $doc = $this->existingDocument;

        $this->documentId = $doc->id;
        $this->reference = $doc->reference;
        $this->objet = $doc->objet;
        $this->description = $doc->description;
        $this->type_document = $doc->type_document;
        $this->date_document = $doc->date_document?->format('Y-m-d');
        $this->date_reception = $doc->date_reception?->format('Y-m-d');
        $this->date_sortie = $doc->date_sortie?->format('Y-m-d');
        $this->provenance = $doc->provenance;
        $this->destinataire = $doc->destinataire;
        $this->statut = $doc->statut;
        $this->priorite = $doc->priorite;
        $this->mention = $doc->mention;
        $this->observations = $doc->observations;
        $this->slug = $doc->slug;
    }

    public function save()
    {
        $this->validate([
            'reference' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'type_document' => 'required|string|max:255',
            'date_document' => 'nullable|date',
            'date_reception' => 'nullable|date',
            'date_sortie' => 'nullable|date',
            'fichier' => 'nullable|file|max:2048', // 2MB max
        ]);

        // Traitement du fichier si présent
        $fichierPath = null;
        if ($this->fichier) {
            $fichierPath = $this->fichier->store('documents', 'public');
        }

        $data = [
            'user_id' => Auth::id(),
            'reference' => $this->reference,
            'objet' => $this->objet,
            'description' => $this->description,
            'type_document' => $this->type_document,
            'date_document' => $this->date_document,
            'date_reception' => $this->date_reception,
            'date_sortie' => $this->date_sortie,
            'provenance' => $this->provenance,
            'destinataire' => $this->destinataire,
            'statut' => $this->statut,
            'priorite' => $this->priorite,
            'mention' => $this->mention,
            'observations' => $this->observations,
        ];

        if ($fichierPath) {
            $data['fichier'] = $fichierPath;
        }

        if ($this->existingDocument) {
            $this->existingDocument->update($data);
            session()->flash('message', 'Document mis à jour avec succès.');
        } else {
            $slugBase = Str::slug($this->reference);
            $slug = $slugBase;
            $counter = 1;

            while (Document::where('slug', $slug)->exists()) {
                $slug = $slugBase . '-' . $counter++;
            }

            $data['slug'] = $slug;

            Document::create($data);
            session()->flash('message', 'Document enregistré avec succès.');
        }

        return redirect()->route('documents.index');
    }

    public function render()
    {
        return view('livewire.pages.register-document');
    }
}
