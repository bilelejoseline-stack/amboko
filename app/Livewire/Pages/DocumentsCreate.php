<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocumentsCreate extends Component
{
    use WithFileUploads;

    // Propriétés du formulaire
    public $reference, $objet, $type_document;
    public $date_document, $date_reception, $date_sortie;
    public $provenance, $destinataire, $statut = 'Enregistré';
    public $priorite = 'Normale', $mention, $description, $observations;
    public $form = ['fichier' => null];

    /**
     * Initialisation des valeurs
     */
    public function mount()
    {
        $this->date_reception = now()->toDateString(); // Date du jour par défaut
    }

    /**
     * Règles de validation
     */
    protected $rules = [
        'reference' => 'required|string|max:255',
        'objet' => 'required|string|max:255',
        'type_document' => 'required|string|max:100',
        'date_document' => 'nullable|date',
        'date_reception' => 'required|date',
        'date_sortie' => 'nullable|date',
        'provenance' => 'nullable|string|max:255',
        'destinataire' => 'nullable|string|max:255',
        'statut' => 'required|string',
        'priorite' => 'required|string',
        'mention' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'observations' => 'nullable|string',
        'form.fichier' => 'nullable|file|max:10240', // 10 Mo max
    ];

    /**
     * Messages personnalisés pour validation
     */
    protected $messages = [
        'reference.required' => 'La référence est obligatoire.',
        'objet.required' => 'L’objet est requis.',
        'type_document.required' => 'Veuillez choisir un type de document.',
        'date_document.date' => 'La date du document doit être valide.',
        'form.fichier.max' => 'Le fichier ne doit pas dépasser 10 Mo.',
    ];

    /**
     * Validation instantanée des champs modifiés
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Enregistrement du document
     */
    public function save()
    {
        try {
            Log::info('Tentative d\'enregistrement de document');

            $this->date_reception = now()->toDateString();

            $this->validate();

            $fichierNom = null;
            if ($this->form['fichier']) {
                $fichierNom = $this->form['fichier']->store('documents', 'public');
                Log::info("Fichier enregistré sous : $fichierNom");
            }

            Document::create([
                'user_id' => Auth::id(),
                'reference' => $this->reference,
                'objet' => $this->objet,
                'type_document' => $this->type_document,
                'date_document' => $this->date_document,
                'date_reception' => $this->date_reception,
                'date_sortie' => $this->date_sortie,
                'provenance' => $this->provenance,
                'destinataire' => $this->destinataire,
                'statut' => $this->statut,
                'priorite' => $this->priorite,
                'mention' => $this->mention,
                'description' => $this->description,
                'observations' => $this->observations,
                'fichier' => $fichierNom,
            ]);

            $this->dispatch('toastr:success', [
                'message' => 'Document enregistré avec succès.'
            ]);

            session()->flash('message', 'Document enregistré avec succès.');
            return redirect()->route('documents.index');

        } catch (\Exception $e) {
            Log::error('Erreur enregistrement document : ' . $e->getMessage());

            $this->dispatch('toastr:error', [
                'message' => 'Erreur : ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Rendu de la vue
     */
    public function render()
    {
        return view('livewire.pages.documents-create');
    }
}
